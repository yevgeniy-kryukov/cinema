<?php

class ControllerOrder extends Controller
{
    public function actionIndex()
    {
        if (!$this->isGuest()) {
            $idUser = $_SESSION["idUser"];
            $dataView = $this->getDataViewHeader();
            $dataView['listUserOrder'] = ModelOrder::showUserOrders($idUser);
            View::generate('/order/index.php', '/layouts/main.php', $dataView);
        }
        return true;
    }

    public function actionView($id)
    {
        if (!$this->isGuest()) {
            $orderTotalSum = 0;
            $orderComplete = 'f';
            $orderInfo = ModelOrder::showTicketOrder($id);
            if ($orderInfo != null) {
                $orderTotalSum = $orderInfo['total'];
                $orderComplete = $orderInfo['complete'];
            }
            $dataView = $this->getDataViewHeader();
            $dataView["idOrder"] = $id;
            $dataView['orderTotalSum'] = $orderTotalSum;
            $dataView['orderComplete'] = $orderComplete;
            $dataView['listItemOrder'] = ModelOrder::showAllItems($id);
            View::generate('/order/view.php', '/layouts/main.php', $dataView);
        }
        return true;
    }

    public function actionDeleteItem($idOrder, $id)
    {
        if (!$this->isGuest()) {
            if (isset($_POST['submit'])) {
                ModelOrder::deleteItem($id);
                header('Location: /order/view/'.$idOrder);
                return;
            }
            $dataView = $this->getDataViewHeader();
            $dataView['idOrder'] = $idOrder;
            $dataView['itemOrder'] = ModelOrder::showOneItem($id);
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
                    $lastCatId = ModelOrder::showItemLastCategory($id);
                    setcookie('cinemaLastCategory', $lastCatId, time() + 60 * 60 * 24 * 7, '/');
                    Utils::sendEmail($_SESSION['emailUser']);
                    return true;
                }
            }
            $orderTotalSum = 0;
            $orderInfo = ModelOrder::showTicketOrder($id);
            if ($orderInfo != null) {
                $orderTotalSum = $orderInfo['total'];
            }
            $dataView = $this->getDataViewHeader();
            $dataView['idOrder'] = $id;
            $dataView['orderTotalSum'] = $orderTotalSum;
            $dataView['listItemOrder'] = ModelOrder::showAllItems($id);
            View::generate('/order/complete.php', '/layouts/main.php', $dataView);
        }
        return true;
    }
}