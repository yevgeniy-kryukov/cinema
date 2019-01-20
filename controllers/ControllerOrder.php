<?php

class ControllerOrder extends Controller
{
    public function actionIndex()
    {
        if (!$this->isGuest()) {
            $idUser = $_SESSION["idUser"];

            $dataView = $this->getDataViewHeader();
            $dataView['listUserOrder'] = ModelOrder::getUserOrders($idUser);
            
            View::generate('/order/index.php', '/layouts/main.php', $dataView);
        }

        return true;
    }

    public function actionView($id)
    {
        if (!$this->isGuest()) {
            $orderTotalSum = 0;
            $orderComplete = 'f';
        
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
            
            View::generate('/order/view.php', '/layouts/main.php', $dataView);
        }

        return true;
    }

    public function actionDeleteOrderItem($idOrder, $id)
    {
        if (!$this->isGuest()) {
            if (isset($_POST['submit'])) {
                ModelOrder::deleteOrderItem($id);
                header('Location: /order/view/'.$idOrder);
                return true;
            }

            $dataView = $this->getDataViewHeader();
            $dataView['idOrder'] = $idOrder;
            $dataView['itemOrder'] = ModelOrder::getOrderItemData($id);
            
            View::generate('/order/delete_item.php', '/layouts/main.php', $dataView);
        }

        return true;
    }

    public function actionComplete($id)
    {
        if (!$this->isGuest()) {
            if (isset($_POST['submit'])) {
                $res = ModelOrder::completeOrder($id);
                if ($res > 0) {
                    header('Location: /order/view/'.$id);
                    $lastCatId = ModelOrder::getCategoryLastOrderItem($id);
                    setcookie('cinemaLastCategory', $lastCatId, time() + 60 * 60 * 24 * 7, '/');
                    Utils::sendEmail($_SESSION['emailUser']);
                    return true;
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

            View::generate('/order/complete.php', '/layouts/main.php', $dataView);
        }
        
        return true;
    }
}