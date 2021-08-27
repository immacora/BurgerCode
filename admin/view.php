<?php
  require 'database.php';

  if(!empty($_GET['id']))
  {
    $id = checkInput($_GET['id']);
  }
  $db = Database::connect();
  $statement = $db->prepare(
    "SELECT items.items_id, items.items_name, items.items_description, items.items_price, items.items_image, categories.categories_name AS category 
    FROM items 
    LEFT JOIN categories 
    ON items.categories_id_fk = categories.categories_id 
    WHERE items.items_id = ?");
  $statement->execute(array($id));
  $item = $statement->fetch();
  Database::disconnect();

  function checkInput($data) 
  {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
  }

?>

<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../css/styles.css">
    <title>Burger Code</title>
  </head>

  <body>
    <h1 class="text-logo"><span class="glyphicon glyphicon-cutlery"></span> Burger Code <span class="glyphicon glyphicon-cutlery"></span></h1>
    <div class="container admin">

      <div class="row">
        <div class="col-sm-6">
          <h1><strong>Détail produit</strong></h1><br>
          <form>
            <div class="form-group">
              <label>Nom:</label><?php echo '  '.$item['items_name'];?>
            </div>
            <div class="form-group">
              <label>Description:</label><?php echo '  '.$item['items_description'];?>
            </div>
            <div class="form-group">
              <label>Prix:</label><?php echo '  '.number_format((float)$item['items_price'], 2, '.', ''). ' €';?>
            </div>
            <div class="form-group">
              <label>Catégorie:</label><?php echo '  '.$item['category'];?>
            </div>
            <div class="form-group">
              <label>Image:</label><?php echo '  '.$item['items_image'];?>
            </div>
          </form>
          <br>
          <div class="form-actions">
          <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
          </div>        
        </div>

        <div class="col-sm-6 site">
          <div class="thumbnail">
            <img src="<?php echo '../images/'.$item['items_image'];?>" alt="...">
            <div class="price"><?php echo number_format((float)$item['items_price'], 2, '.', ''). ' €';?></div>
            <div class="caption">
              <h4><?php echo $item['items_name'];?></h4>
              <p><?php echo $item['items_description'];?></p>
              <a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"></span> Commander</a>
            </div>
          </div>
        </div>

      </div>      
    </div>
  </body>
</html>