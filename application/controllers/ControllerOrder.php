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
        $idUser = $_SESSION["idUser"];
        $dataView['listUserOrder'] = $this->model->showUserOrders($idUser);
        $this->view->generate('/order/index.php', '/layouts/main.php', $dataView);
    }

    public function actionView(int $id)
    {
        $orderTotalSum = 0;
        $orderComplete = 'f';
        $orderInfo = $this->model->showTicketOrder($id);
        if ($orderInfo != null) {
            $orderTotalSum = $orderInfo['total'];
            $orderComplete = $orderInfo['complete'];
        }
        $dataView["idOrder"] = $id;
        $dataView['orderTotalSum'] = $orderTotalSum;
        $dataView['orderComplete'] = $orderComplete;
        $dataView['listItemOrder'] = $this->model->showAllItems($id);
        $this->view->generate('/order/view.php', '/layouts/main.php', $dataView);
    }

    public function actionDeleteItem(int $idOrder, int $id)
    {
        if (isset($_POST['submit'])) {
            $this->model->deleteItem($id);
            header('Location: /order/view/'.$idOrder);
            return;
        }
        $dataView['idOrder'] = $idOrder;
        $dataView['itemOrder'] = $this->model->showOneItem($id);
        $this->view->generate('/order/delete_item.php', '/layouts/main.php', $dataView);
    }

    public function actionComplete(int $id)
    {
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
        $dataView['idOrder'] = $id;
        $dataView['orderTotalSum'] = $orderTotalSum;
        $dataView['listItemOrder'] = $this->model->showAllItems($id);
        $this->view->generate('/order/complete.php', '/layouts/main.php', $dataView);
    }
}