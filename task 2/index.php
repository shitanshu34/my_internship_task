<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Portfolio - Task 2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Maintain aspect ratio for Carousel and Card images */
        .carousel-item img {
            height: 450px;
            object-fit: cover;
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body class="bg-light">

    <?php include 'header.php'; ?>

    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=1200&h=450&q=80" class="d-block w-100" alt="Web Development">
          <div class="carousel-caption d-none d-md-block">
            <h2 class="fw-bold">Modern Web Development</h2>
            <p>Mastering Bootstrap 5 for high-performance responsive layouts.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=1200&h=450&q=80" class="d-block w-100" alt="UI Design">
          <div class="carousel-caption d-none d-md-block">
            <h2 class="fw-bold">Interactive User Interfaces</h2>
            <p>Developing user-centric designs with modern frontend frameworks.</p>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
    </div>

    <div class="container mt-5 pt-3">
        <h2 class="text-center mb-5 fw-bold text-secondary">Projects & Expertise</h2>
        
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0 px-1"> <img src="https://images.unsplash.com/photo-1547658719-da2b51169166?auto=format&fit=crop&w=400&h=250&q=80" class="card-img-top" alt="Design">
                    <div class="card-body text-center">
                        <h5 class="card-title text-primary fw-bold">Web Design</h5>
                        <p class="card-text text-muted">Utilizing Bootstrap 5 to create seamless, responsive layouts that function perfectly across all devices.</p>
                        <a href="#" class="btn btn-outline-primary px-4">View Project</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0 px-1">
                    <img src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=400&h=250&q=80" class="card-img-top" alt="Frontend">
                    <div class="card-body text-center">
                        <h5 class="card-title text-success fw-bold">Frontend Mastery</h5>
                        <p class="card-text text-muted">Implementing interactive UI elements using HTML5, CSS3, and modern JavaScript libraries.</p>
                        <a href="#" class="btn btn-outline-success px-4">Explore Demo</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0 px-1">
                    <img src="https://images.unsplash.com/photo-1587620962725-abab7fe55159?auto=format&fit=crop&w=400&h=250&q=80" class="card-img-top" alt="Backend">
                    <div class="card-body text-center">
                        <h5 class="card-title text-danger fw-bold">Backend Systems</h5>
                        <p class="card-text text-muted">Developing secure server-side logic and database connectivity using PHP and MySQL.</p>
                        <a href="#" class="btn btn-outline-danger px-4">See Code</a>
                    </div>
                </div>
            </div>
        </div>

        <?php include 'footer.php'; ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>