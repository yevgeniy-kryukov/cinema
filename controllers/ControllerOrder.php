<?php

class ControllerOrder extends Controller
{
    public function __construct()
    {
        $this->view = new View();
        $this->model = new ModelOrder();
    }

    public function actionIndex()
    {
        if (!$this->isGuest()) {
            $idUser = $_SESSION["idUser"];
            $dataView = $this->getDataViewHeader();
            $dataView['listUserOrder'] = $this->model->showUserOrders($idUser);
            $this->view->generate('/order/index.php', '/layouts/main.php', $dataView);
        }
        return true;
    }

    public function actionView(int $id)
    {
        if (!$this->isGuest()) {
            $orderTotalSum = 0;
            $orderComplete = 'f';
            $orderInfo = $this->model->showTicketOrder($id);
            if ($orderInfo != null) {
                $orderTotalSum = $orderInfo['total'];
                $orderComplete = $orderInfo['complete'];
            }
            $dataView = $this->getDataViewHeader();
            $dataView["idOrder"] = $id;
            $dataView['orderTotalSum'] = $orderTotalSum;
            $dataView['orderComplete'] = $orderComplete;
            $dataView['listItemOrder'] = $this->model->showAllItems($id);
            $this->view->generate('/order/view.php', '/layouts/main.php', $dataView);
        }
        return true;
    }

    public function actionDeleteItem(int $idOrder, int $id)
    {
        if (!$this->isGuest()) {
            if (isset($_POST['submit'])) {
                $this->model->deleteItem($id);
                header('Location: /order/view/'.$idOrder);
                return;
            }
            $dataView = $this->getDataViewHeader();
            $dataView['idOrder'] = $idOrder;
            $dataView['itemOrder'] = $this->model->showOneItem($id);
            $this->view->generate('/order/delete_item.php', '/layouts/main.php', $dataView);
        }
        return true;
    }

    public function actionComplete(int $id)
    {
        if (!$this->isGuest()) {
            if (isset($_POST['submit'])) {
                $res = $this->model->completeOrder($id);
                if ($res > 0) {
                    header('Location: /order/view/'.$id);
                    $lastCatId = $this->model->showItemLastCategory($id);
                    setcookie('cinemaLastCategory', $lastCatId, time() + 60 * 60 * 24 * 7, '/');
                    Utils::sendEmail($_SESSION['emailUser']);
                    return;
                }
            }
            $orderTotalSum = 0;
            $orderInfo = $this->model->showTicketOrder($id);
            if ($orderInfo != null) {
                $orderTotalSum = $orderInfo['total'];
            }
            $dataView = $this->getDataViewHeader();
            $dataView['idOrder'] = $id;
            $dataView['orderTotalSum'] = $orderTotalSum;
            $dataView['listItemOrder'] = $this->model->showAllItems($id);
            $this->view->generate('/order/complete.php', '/layouts/main.php', $dataView);
        }
        return true;
    }
}