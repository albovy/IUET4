<?php

    class Show_Pujas{
        var $pujas;

        function __construct($pujas){
            $this->pujas = $pujas;

            $this->render();
        }

        function render(){
            include '../Views/Header.php'; 
            if(count($this->pujas) == 0){
                ?>
                <h1><?=$strings['No hiciste pujas']?></h1>
                <?php
            }else{
                ?>
                <div class="tabla">
                    <h2 class="textoForm"><?= $strings['ShowAll subastas'] ?></h2>
                    <table class="table">
                    <thead>
                    
                    <th class="thShowAll">ID</th>
                    <th class="thShowAll"><?= $strings['Dinero'] ?></th>
                    <th class="thShowAll"><?= $strings['ID Subasta']?></th>
                
                
                    
                    </thead>
                        <tbody>
                    <?php 
                        foreach($this->pujas as $puja){
                           
                            ?>
                            <tr>
                            
                            <td class="tdShowAll"><?= $puja->getID() ?></td>
                            <td class="tdShowAll"><?= $puja->getDinero() ?></td>
                            <td class="tdShowAll"><?= $puja->getIDSubasta() ?></td>


                            </tr>
    <?php
                        }
    ?>
                        </tbody>
                </table>
                    </div>
    <?php
        }
    }
}
?>