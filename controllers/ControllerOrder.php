<?php

class ControllerOrder extends Controller
{
    public function actionIndex()
    {
        $this->checkAccessUser();

        $idUser = $_SESSION["idUser"];

        $dataView = $this->getDataViewHeader();
        $dataView['listUserOrder'] = ModelOrder::getUserOrders($idUser);
        
        $this->generate('order/index.php', 'layouts/main.php', $dataView);

        return true;
    }

    public function actionView($id)
    {
        $this->checkAccessUser();

        $orderTotalSum = 0;
        $orderComplete = 0;
    
        $orderInfo = ModelOrder::getOrderData($id);
        if ($orderInfo != null) {
            $orderTotalSum = $orderInfo['total'];
            $orderComplete = $orderInfo['complete'];
        }

        $dataView = $this->getDataViewHeader();
        $dataView["idOrder"] = $id;
        $dataView['orderTotalSum'] = $orderTotalSum;
        $dataView['orderComplete'] = $orderComplete;
        $dataView['orderItems'] = ModelOrder::getOrderItems($id);

        $this->generate('order/view.php', 'layouts/main.php', $dataView);

        return true;
    }

    public function actionComplete($id)
    {
        $this->checkAccessUser();
        
        if (isset($_POST['submit'])) {
            $res = ModelOrder::completeOrder($id);
            if ($res > 0) {
                header('Location: /order/view/' . $id);
                $lastCatId = ModelOrder::getCategoryLastOrderItem($id);
                setcookie('cinemaLastCategory', $lastCatId, time() + 60 * 60 * 24 * 7, '/');
                Utils::sendEmail($_SESSION['emailUser']);
                exit;
            }
        }
        
        $orderTotalSum = 0;
        $orderInfo = ModelOrder::getOrderData($id);
        if ($orderInfo != null) {
            $orderTotalSum = $orderInfo['total'];
        }

        $dataView = $this->getDataViewHeader();
        $dataView['idOrder'] = $id;
        $dataView['orderTotalSum'] = $orderTotalSum;
        $dataView['orderItems'] = ModelOrder::getOrderItems($id);

        $this->generate('order/complete.php', 'layouts/main.php', $dataView);
        
        return true;
    }
}