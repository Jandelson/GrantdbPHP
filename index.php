<!DOCTYPE html>
<html>
    <head>
        <title>GrantdbPHP by | Jandelson Oliveira</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
        <div class="jumbotron">
            <div class="container">
                <h3>GrantdbPHP</h3>
                <div class="row">
                    <div class="col-md-8">
                        <form class="form-horizontal" action="action.php" method="post">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input type="text" name="user" class="form-control" placeholder="usuario db">
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <input type="checkbox" name="like" value="1" title="User Like?">
                                    </span>
                                    <input type="text" name="prefixo" class="form-control" placeholder="prefixo tabela">
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="post" class="btn btn-default">Gerar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Result -->
        <div class="col-md-8">
            <?php echo $_GET['result'];?>
        </div>
    </body>
</html>