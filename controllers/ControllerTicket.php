<?php

class ControllerTicket extends Controller
{
    public function __construct()
    {
        $this->view = new View();
        $this->model = new ModelTicket();
    }
    
    public function actionIndex(int $id)
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
                    $ticketsStatus = 'TicketsZero';
                } else {
                    $idOrder = $this->model->getIdOrder($idUser);
                    if ($idOrder > 0) {
                        $resAddItem = $this->model->addItem($idUser, $id, $idOrder, $adultTickets, $childTickets);
                    } else {
                        $resAddItem = 0;
                    }

                    if ($resAddItem > 0) {
                        $ticketsStatus = 'SuccessAdded';
                    } else if ($resAddItem == -5) {
                        $ticketsStatus = 'AlreadyAdded';
                    } else {
                        $ticketsStatus = 'UnknownError';
                    }
                }
            } else {
                $ticketsStatus = '';
            }
        
            $dataView = $this->getDataViewHeader();
            $dataView['idOrder'] = $idOrder;
            $dataView['infoShow'] = $this->model->infoShow($id);
            $dataView['adultTickets'] = $adultTickets;
            $dataView['childTickets'] = $childTickets;
            $dataView['ticketsStatus'] = $ticketsStatus;
                
            $this->view->generate('/ticket/index.php', '/layouts/main.php', $dataView);
        }
        return true;
    }
    
}
