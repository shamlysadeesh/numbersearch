 <?php  
 $connect = mysqli_connect("localhost", "root", "", "defence");  
 if(isset($_POST["submit"]))  
 {  
      if(!empty($_POST["search"]))  
      {  
           $query = str_replace("\r\n", "+", $_POST["search"]);  
           header("location:number search.php?search=" . $query);  
      }  
 }  
 ?>  
 <!DOCTYPE html>  
 <html>  
      
      <body>  
           <br /><br />  
           
                <h3 align="center">Search multiple words at a time in Mysql php</h3><br />  
                <form method="post" id="usrform">  
                     <label>Enter Search Text</label>  
                     <textarea name="search" rows="5"value="<?php if(isset($_POST["search"])) echo $_POST["search"]; ?>"form="usrform"></textarea>
                     <br />  
                     <input type="submit" name="submit" value="Search">  
                </form>  
                <br /><br />  
                
                     <?php  
                     if(isset($_GET["search"]))  
                     {  
                          $condition = '';  
                          $query = explode(" ", $_GET["search"]);  
                          foreach($query as $text)  
                          {  
                               $condition .= "number LIKE '%".mysqli_real_escape_string($connect, $text)."%' OR ";  
                          }  
                          $condition = substr($condition, 0, -4);  
                          $sql_query = "SELECT * FROM phone_nos WHERE " . $condition;  
                          $result = mysqli_query($connect, $sql_query);  
                          if(mysqli_num_rows($result) > 0)  
                          {  
                               while($row = mysqli_fetch_array($result))  
                               {  
                                    echo '<tr><td>'.$row["number"].'</td><td>'."\n".'</td><td>'.$row["name"].'</td></tr><BR>';  
                               }  
                          }  
                          else  
                          {  
                               echo '<label>Data not Found</label>';  
                          }  
                     }  
                     ?>  
                     </table>    
      </body>  
	  </html>