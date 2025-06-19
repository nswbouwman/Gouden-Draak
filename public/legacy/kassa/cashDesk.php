<div id="cashDeskPage">
    <div id="cashDeskLeft">
        <div id="itemsToSelect">
            <?php
                $menuItems = array();
                $menuItemsType = array();

                // get all items from database
                require_once('config/dbconfig.php');

                $conn = mysqli_connect(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_DBNAME);

                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                } else {
                    // get all menu items
                    $sql = "SELECT * FROM menu ORDER BY id, menunummer, menu_toevoeging";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row=$result->fetch_assoc()){
                            $menuItems[] = $row;
                        }
                    }

                    // get all menu item types
                    $sql = "SELECT DISTINCT soortgerecht FROM menu";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row=$result->fetch_assoc()){
                            $menuItemsType[] = $row["soortgerecht"];
                        }
                    }

                    $conn->close();
                }

                for($index=0; $index < sizeof($menuItems); $index++){
                    $currentItem = $menuItems[$index];
                    // check menuItem
                    if(in_array($currentItem["soortgerecht"],$menuItemsType)){
                        // New menu item type
                        echo("<div class='menuItemType'>".$currentItem["soortgerecht"]."</div>");
                        $menuItemsType = array_diff($menuItemsType, array($currentItem["soortgerecht"]));
                        echo("<table class='itemToSelectTable'>");
                        echo("<tbody>");        
                    }

                    ?>
                        
                            <tr>
                                <td>
                                    <?php echo($currentItem["menunummer"].$currentItem["menu_toevoeging"].".") ?>
                                </td>

                                <td>
                                    <?php 
                                        if($currentItem["beschrijving"]!=null && $currentItem["beschrijving"]!=""){
                                            echo($currentItem["naam"]." "."<i>(".$currentItem["beschrijving"].")</i>");
                                        } else {
                                            echo($currentItem["naam"]);
                                        }
                                    ?>
                                </td>

                                <td>
                                    <?php echo("€ ".number_format($currentItem["price"], 2, ',', ' ')) ?>
                                </td>

                                <td>
                                    <?php echo("<button class='addMenuItem' value='".$currentItem["id"]."'>Toevoegen</button>") ?>
                                </td>
                            </tr>

                    <?php

                    if(
                        (($index+1) < sizeof($menuItems) && $menuItems[$index]["soortgerecht"] != $menuItems[$index+1]["soortgerecht"])
                        || (($index+1) >= sizeof($menuItems))
                    ){
                        echo("</tbody>");
                        echo("</table>");        
                    }
                }
            ?>
        </div>
    </div>
    <div id="cashDeskRight">
        <div id="itemsSelectedContainer">
            <div id="itemsSelected">
                <div class='orderHeader'>Bestelling</div>

                <table class='itemSelectedTable'>
                    <?php
                        for($index=0; $index < sizeof($menuItems); $index++){
                            $currentItem = $menuItems[$index];
                            ?>
                                    <tr class="hidden menuItem_<?php echo($currentItem["id"]); ?>" data-price="<?php echo($currentItem["price"]); ?>">
                                        <td>
                                            <?php echo($currentItem["menunummer"].$currentItem["menu_toevoeging"].".") ?>
                                        </td>

                                        <td>
                                            <?php 
                                                if($currentItem["beschrijving"]!=null && $currentItem["beschrijving"]!=""){
                                                    echo($currentItem["naam"]." "."<i>(".$currentItem["beschrijving"].")</i>");
                                                } else {
                                                    echo($currentItem["naam"]);
                                                }
                                            ?>
                                        </td>

                                        <td>
                                            <span>€ </span><span class="subAmount"><?php echo(number_format($currentItem["price"], 2, ',', ' ')) ?></span>
                                        </td>

                                        <td>
                                            <input type="number" name="<?php echo($currentItem["id"]);?>" min="0" value="0">
                                        </td>
                                    </tr>

                            <?php
                        }
                    ?>
                </table>
            </div>
            <div id="itemsSelectedTotal">
                <table class='itemSelectedTotalTable'>
                    <tr>
                        <td>
                        </td>

                        <td>
                            Totaal:
                        </td>

                        <td>
                            <span>€ </span><span class="totalAmount">0,00</span>
                        </td>

                        <td>
                            <button id="payOrder">Afrekenen</button>
                            <button id="clearOrder">Verwijderen</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>