
<a id="readme-top"></a>


<!-- PROJECT LOGO -->
<br />
<div align="center">
  <a href="#">
    <img src="public/images/logo.svg" alt="Laravel Logo" width="80" height="80">
  </a>

  <h3 align="center">Laravel Appointment Booking Example</h3>

  <p align="center">
    An example project!
    <br />
    <a href="#docs"><strong>Explore the docs »</strong></a>
    <br />
    <br />
    <a href="#demo">View Demo</a>
    &middot;
    <a href="https://github.com/gyanverma2/LaravelAppointment/issues">Report Bug</a>
    &middot;
    <a href="https://github.com/gyanverma2/LaravelAppointment/issues">Request Feature</a>
  </p>
</div>



<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
     <li><a href="#roadmap">Roadmap</a></li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#license">License</a></li>
    <li><a href="#contact">Contact</a></li>
    
  </ol>
</details>



<!-- ABOUT THE PROJECT -->
## About The Project
<video src="https://github.com/gyanverma2/LaravelAppointment/public/images/DemoVideo.mp4" width="300" height="300" ></video>


This is a sample booking application demostrating the use of Laravel REST API.

Requirment:  
* There should be an endpoint where I can book an appointment
* The data sent to the endpoint should be the service id (int), the health professional id (int), a date and an email
* The appointment should be stored
* After the booking, an email should be sent to the email passed in the request (but email should not actually be sent out)


<p align="right">(<a href="#readme-top">back to top</a>)</p>



### Built With

This section should list any major frameworks/libraries used to bootstrap your project. Leave any add-ons/plugins for the acknowledgements section. Here are a few examples.

* Laravel [Laravel]
* Laravel Documentation [Laravel-11x]
* Swagger [Swagger]
* SQLite [SQLite]

<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- GETTING STARTED -->
## Getting Started

Follow these bellow steps to start the project in local development enviornment

### Prerequisites

To run Laravel on a local machine, you need to have the following prerequisites:

- **PHP**: PHP version 7.3 or higher.
  - You can download PHP from [php.net](https://www.php.net/downloads).
  - On Windows, you can use [XAMPP](https://www.apachefriends.org/index.html) or [WampServer](http://www.wampserver.com/en/).
  - On macOS, you can use [Homebrew](https://brew.sh/) to install PHP: `brew install php`.

- **Composer**: Composer is a dependency manager for PHP.
  - You can download and install Composer from [getcomposer.org](https://getcomposer.org/download/).

- **Web Server**: Apache or Nginx.
  - For Apache, you can use [XAMPP](https://www.apachefriends.org/index.html) or [WampServer](http://www.wampserver.com/en/).
  - For Nginx, you can follow the installation instructions on the [Nginx website](https://nginx.org/en/download.html).

- **Database**: MySQL, PostgreSQL, SQLite, or SQL Server.
  - For MySQL, you can use [XAMPP](https://www.apachefriends.org/index.html) or download from [mysql.com](https://dev.mysql.com/downloads/).
  - For PostgreSQL, you can download from [postgresql.org](https://www.postgresql.org/download/).
  - SQLite is included with PHP.
  - For SQL Server, you can download from [Microsoft](https://www.microsoft.com/en-us/sql-server/sql-server-downloads).


### Installation

To install and run the project, follow these steps:

1. **Clone the repository**:
   ```sh
   git clone https://github.com/gyanverma2/LaravelAppointment.git
   cd LaravelAppointment

2. **Install Composer**:
   ```sh
   composer install

3. **Env Setup**:
   ```sh
   cp .env.example .env
   php artisan key:generate

4. **Run database migrations**:
   ```sh
   php artisan migrate

5. **Start Development Server**:
   ```sh
   php artisan serve

6. **Access the application**:
    Open your web browser and go to http://localhost:8000.

<p align="right">(<a href="#readme-top">back to top</a>)</p>


<!-- ROADMAP -->
## Roadmap

- [ ] Add Authentication
- [ ] Add Additional validation
- [ ] Add Additional Tables & Relations


See the [open issues](https://github.com/gyanverma2/LaravelAppointment/issues) for a full list of proposed features (and known issues).

<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- CONTRIBUTING -->
## Contributing

Any contributions you make are **greatly appreciated**.

If you have a suggestion that would make this better, please fork the repo and create a pull request. You can also simply open an issue with the tag "enhancement".
Don't forget to give the project a star! Thanks again!

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- LICENSE -->
## License

Distributed under the Unlicense License. See `LICENSE.txt` for more information.

<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- CONTACT -->
## Contact

Nishant Kumar Verma - [Linkedin](https://www.linkedin.com/in/gyanverma/) - nisgyan@gmail.com


<p align="right">(<a href="#readme-top">back to top</a>)</p>


<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->
[Laravel]: https://laravel.com/
[Laravel-11x]: https://laravel.com/docs/11.x
[Swagger]: https://swagger.io/
[SQLite]: https://www.sqlite.org/