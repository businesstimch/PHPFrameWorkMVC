# PHP MVC Pattern Framework

This is a PHP framework built on the Model-View-Controller (MVC) architectural pattern. The framework is designed to help developers create scalable and maintainable web applications with ease. One of its unique features is the ability to run multiple websites under one core.

## Folder Structure
- Core: Contains all core logics.
- Site: Individual website files. The folder name should match the domain name (e.g., domain.com).

## Features
- Model-View-Controller (MVC) pattern for separation of concerns.
- Supports dynamic URL creation: Each controller folder and file structure will be matched with a URL, making it easy to add new URLs and maintain them.
- Supports magic class load: Just add a new class into the class folder under a specific rule, and you will be able to load the class from everywhere.
- One core but serves multiple services: You don't need to install multiple cores to run multiple services. This is a great method if you have multiple websites that don't have heavy traffic and will not affect each other's services. Note: Cons is the face that it can crash all your services because of one service crash.

## Requirements
- PHP version 5.6 (Code migration will be required to use the latest PHP version)
- Web server with support for URL rewriting (e.g., Apache, Nginx)
- Database system (e.g., MySQL, or you can create your own database class)

## Installation
- Clone or download the framework from GitHub.
- Configure your web server to point to the public root directory.
- Create a new website directory under the 'Site' folder for each website you want to host.
- Run the database migration tool to create the necessary tables for each website.

## Getting Started
- Create your controllers in the Site/your_domain_name/Frontend/App/Controller directory of each website. (Controller/Model folder will be moved in Backend folder in the future)
- Define your models in the Site/your_domain_name/Frontend/App/Model directory of each website.
- Create your views in the Site/your_domain_name/Frontend/App/View directory of each website.
- Use the built-in helper functions to generate URLs, load views, and access the database.

## Contributing
- Contributions are welcome! Please read the contribution guidelines before submitting a pull request.
