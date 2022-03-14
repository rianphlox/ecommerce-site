<?php
    
    require 'config/db.php';

    session_start();
    $name = isset($_SESSION['name']) ? $_SESSION['name'] : "Guest";
    $db = new DB('sql306.epizy.com', 'epiz_25023672', 'RBTXS7KOenTLR', 'epiz_25023672_phpblog');
    $conn = $db->conn;
    

    $query = "SELECT * FROM posts";
    $result = $conn->query($query);
    $posts = $result->fetch_all(MYSQLI_ASSOC);
    $result->free_result();
    $conn->close();

?>
<?php include 'navbar.php'; ?>


<?php if($posts): ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-dismissible alert-primary">
                    <span>Welcome <?php echo $name; ?>!</span>
                    <button role="button" class="close">&times;</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class='col-12'>
                <a href="https://xmlgrab.com/show.php?l=0&u=299882&id=29827"><button>https://xmlgrab.com/show.php?l=0&u=299882&id=29827</button></a>
            </div>
        </div>
        <div class="row">
            <?php foreach($posts as $post): ?>
                <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
                    <div class="card h-100 border-success">
                        <div class="card-body">
                            <h4 class="card-title"><?= $post['title']; ?></h4>
                            <div class="dropdown-divider"></div>
                            
                            <span><?= $post['body']; ?></span>
                            <p>Created by <?= $post['author']; ?> on <br>
                                <?= $post['time']; ?> 
                            </p>
                            <a href="post?id=<?= $post['id']; ?>" class="btn btn-warning">Read More</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>    
        </div>
    </div>
<?php endif; ?>    

<script>
    const alert = document.querySelector('.alert')
    alert.addEventListener('click', () => {
        alert.remove()
    })
</script>

<?php include 'footer.php'; ?>