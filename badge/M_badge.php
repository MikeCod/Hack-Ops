<? 
require "../M_bdd.php";

function req_add_badge() {
    try {
        if (!($link = connect_start())) {
            throw new Exception("DataBase load failed !");
        } else if(!($result = $link->query("INSERT INTO badges(name, value, description, type) 
            VALUES(".$link->quote($_POST['name']).",
            ".$link->quote($_POST['level']).",
            ".$link->quote($_POST['desc']).",
            ".$link->quote($_POST['type']).")"))) 
        {
            throw new Exception("No access to the table");
        }
        header("Location: ./");
        exit();
    
    } catch (Exception $th) {
        echo "Internal error: ".$th->getMessage();
    }
    connect_end($link);
}

?>