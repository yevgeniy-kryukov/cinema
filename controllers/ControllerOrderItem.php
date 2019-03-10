<?php

class ControllerOrderItem extends Controller
{
   
    public function actionIndex($idShow)
    {
        $this->checkAccessUser();

        $idUser = $_SESSION['idUser'];
        $adultTickets = 2;
        $childTickets = 0;
        $idOrder = null;
            
        if (isset($_POST['adultTickets']) && isset($_POST['childTickets'])) {
            $adultTickets = $_POST['adultTickets'];
            $childTickets = $_POST['childTickets'];

            if ( ($adultTickets == 0) && ($childTickets == 0) ) {
                $error = 'TicketsZero';
            } else {
                $idOrder = ModelOrder::getIdOrder($idUser);
                if ($idOrder > 0) {
                    $resAddItem = ModelOrderItem::addOrderItem($idShow, $idOrder, $adultTickets, $childTickets);
                } else {
                    $resAddItem = -10;
                }

                if ($resAddItem > 0) {
                    $error = 'SuccessAdded';
                } else if ($resAddItem == -5) {
                    $error = 'AlreadyAdded';
                } else {
                    $error = 'UnknownError';
                }
            }
        } else {
            $error = '';
        }
    
        $dataView = $this->getDataViewHeader();
        $dataView['idOrder'] = $idOrder;
        $dataView['infoShow'] = ModelShow::getShowData($idShow);
        $dataView['adultTickets'] = $adultTickets;
        $dataView['childTickets'] = $childTickets;
        $dataView['error'] = $error;
            
        $this->generate('order_item/index.php', 'layouts/main.php', $dataView);
        
        return true;
    }

    public function actionDelete($idOrder, $id)
    {
        $this->checkAccessUser();

        if (isset($_POST['submit'])) {
            ModelOrderItem::deleteOrderItem($id);
            header('Location: /order/view/'.$idOrder);
            exit;
        }

        $dataView = $this->getDataViewHeader();
        $dataView['idOrder'] = $idOrder;
        $dataView['itemOrder'] = ModelOrderItem::getOrderItemData($id);
        
        $this->generate('order_item/delete.php', 'layouts/main.php', $dataView);

        return true;
    }

    
}
