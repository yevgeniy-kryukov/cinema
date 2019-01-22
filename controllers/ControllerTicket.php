<?php

class ControllerTicket extends Controller
{
   
    public function actionIndex($id)
    {
       if (!$this->isGuest()) {
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
                    $idOrder = ModelTicket::getIdOrder($idUser);
                    if ($idOrder > 0) {
                        $resAddItem = ModelTicket::addOrderItem($idUser, $id, $idOrder, $adultTickets, $childTickets);
                    } else {
                        $resAddItem = 0;
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
            $dataView['infoShow'] = ModelTicket::getShowData($id);
            $dataView['adultTickets'] = $adultTickets;
            $dataView['childTickets'] = $childTickets;
            $dataView['error'] = $error;
                
            View::generate('ticket/index.php', 'layouts/main.php', $dataView);
        }
        
        return true;
    }
    
}
