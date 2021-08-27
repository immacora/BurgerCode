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
        <h1><strong>Liste des items </strong><a href="insert.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span> Ajouter</a></h1>
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>Nom</th>
              <th>Description</th>
              <th>Prix</th>
              <th>Catégorie</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
              require 'database.php';
              $db = Database::connect();
              $statement = $db->query(
                'SELECT items.items_id, items.items_name, items.items_description, items.items_price, categories.categories_name AS category 
                FROM items 
                LEFT JOIN categories 
                ON items.categories_id_fk = categories.categories_id 
                ORDER BY items.items_id DESC');
              while($item = $statement->fetch())
              {
                echo '<tr>';
                  echo '<td>'. $item['items_name'] . '</td>';
                  echo '<td>'. $item['items_description'] . '</td>';
                  echo '<td>'. number_format($item['items_price'], 2, '.', '') . '</td>';
                  echo '<td>'. $item['category'] . '</td>';
                  echo '<td width=350>';
                    echo '<a class="btn btn-default" href="view.php?id='.$item['items_id'].'"><span class="glyphicon glyphicon-eye-open"></span> Voir</a>';
                    echo ' ';
                    echo '<a class="btn btn-primary" href="update.php?id='.$item['items_id'].'"><span class="glyphicon glyphicon-pencil"></span> Modifier</a>';
                    echo ' ';
                    echo '<a class="btn btn-danger" href="delete.php?id='.$item['items_id'].'"><span class="glyphicon glyphicon-remove"></span> Supprimer</a>';
                  echo '</td>';
                echo '</tr>';
              }
              Database::disconnect();
            ?>
          </tbody>
        </table>
      </div>      
    </div>
  </body>
</html>