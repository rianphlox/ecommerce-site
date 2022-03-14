<?php
    
    require_once 'config/db.php';
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    $query = "SELECT * FROM posts WHERE id =" . $id;
    $result = mysqli_query($conn, $query);
    $post = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    mysqli_close($conn);


    ?>
    <?php include 'navbar.php' ?>
    
    <div class="container mt-3">
        <a href="blog" >
            <button class="btn btn-light">Back</button>
        </a>
        <div class="row justify-content-center">
            <?php if ($post): ?>
                <div class="col-sm-12 col-md-6">
                    <div class="card border-success">
                        
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $post['title']; ?></h4>
                            <div class="card-text">
                                <?php echo $post['body']; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <script>
        var btn = document.querySelector(".btn")
        
    </script>