<?=$this->extend('client/layouts/main')?>
<?=$this->section('content')?>

<style>
        /* Additional styles for the About Us page */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        nav {
            background-color: #343a40;
            color: #ffffff;
            padding: 10px 0;
        }

        nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            margin: 0 20px;
        }

        header {
            background-color: #343a40;
            color: #ffffff;
            text-align: center;
            padding: 60px 0;
        }

        h1 {
            font-size: 36px;
        }

        main {
            padding: 30px;
            background-color: #ffffff;
            margin: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 24px;
            margin-top: 0;
        }

        p {
            font-size: 16px;
            line-height: 1.5;
        }

        footer {
            background-color: #343a40;
            color: #ffffff;
            text-align: center;
            padding: 10px 0;
        }
    </style>
    <!-- Navigation -->
   

    <!-- Header -->
    <header class="bg-blue">
        <h1>About Us</h1>
    </header>

    <!-- Main Content -->
    <main>
        <section>
            <h2>Our Story</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eget dapibus massa. Nullam in lectus a nisi lacinia aliquet. Sed eu neque vel lorem consequat tincidunt.</p>
        </section>

        <section>
            <h2>Our Mission</h2>
            <p>Our mission is to provide high-quality products and services to our customers. We are dedicated to customer satisfaction and innovation in everything we do.</p>
        </section>

        <!-- Add more sections and content as needed -->
    </main>

    <!-- Footer -->
    <footer class="bg-blue">
        <h2>&copy; 2023 ShopWise</h2>
    </footer>

    <!-- JavaScript files or scripts can be added here if needed -->

<?=$this->endSection()?>