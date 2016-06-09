# Currency Exchange Application

Currency Exchange Application is the php project developed using Laravel 5.2 as a API backend and AngularJS as a frontend.

It offer users to purchase exchanged currencies.

## Prerequisites

 * php5-cli on your machine
 * composer

## Installation Guide

1. php5-cli install on Ubuntu machine
    ```
      sudo apt-get install php5-cli
    ``` 

2. Composer install on Ubuntu machine
    ```
      curl -sS https://getcomposer.org/installer | php
    ``` 
    ``` 
      sudo mv composer.phar /usr/local/bin/composer
    ``` 
    ``` 
      sudo chmod +x /usr/local/bin/composer
     ``` 

3. In project directory run command
    ``` 
      composer install
     ``` 

5. Install npm 
    ``` 
      npm install
     ``` 

6. Run gulp 
    ``` 
      gulp
     ``` 

7. In root directory create .env file and paste the following
    ``` 
      APP_ENV=local
      APP_DEBUG=true
      APP_KEY=base64:RqmoeYTERvDeT5FohWfRbNYDQKHrhUp4PVkHqd7rORg=
      APP_URL=http://localhost
      
      DB_CONNECTION=mysql
      DB_HOST=127.0.0.1
      DB_PORT=3306
      DB_DATABASE=currencyExchange
      DB_USERNAME=DBUSERNAME
      DB_PASSWORD=DBPASSWORD
      
      CACHE_DRIVER=file
      SESSION_DRIVER=file
      QUEUE_DRIVER=sync
      
      REDIS_HOST=127.0.0.1
      REDIS_PASSWORD=null
      REDIS_PORT=6379
      
      MAIL_DRIVER=smtp
      MAIL_HOST=smtp.gmail.com
      MAIL_PORT=465
      MAIL_USERNAME=GMAILUSERNAME
      MAIL_PASSWORD=GMAILPASSWORD
      MAIL_ENCRYPTION=ssl

     ``` 

8. Connect to the mysql on terminal and enter mysql pw (note: root is the db user)
    ``` 
      mysql -u root -h localhost -p
     ``` 

9. In mysql terminal create database
    ``` 
      create database currencyExchange;
     ``` 

10. Migrate tables to database in terminal type
    ``` 
      php artisan migrate
     ``` 
    Output:
    ```
      Migration table created successfully.
      Migrated: 2014_10_12_000000_create_users_table
      Migrated: 2014_10_12_100000_create_password_resets_table
      Migrated: 2016_05_29_142901_create_orders_table
      Migrated: 2016_05_30_133256_create_surcharges_table
      Migrated: 2016_05_30_133548_create_exchanged_rates_table
      Migrated: 2016_06_05_225100_create_actions_table
      Migrated: 2016_06_05_225119_create_emails_table
      Migrated: 2016_06_05_225145_create_discounts_table
    ```

11. Seed data to database
    ``` 
      php artisan db:seed
     ``` 
    Output:
    ```
      Seeded: SurchargesTableSeeder
      Surcharge table seeded!
      Seeded: ActionsTableSeeder
      Actions table seeded!
      Seeded: DiscountsTableSeeder
      Discounts table seeded!
      Seeded: EmailsTableSeeder
      Emails table seeded!
    ```

12. Create cron job for calling scheduler, enter in terminal
    ``` 
      crontab -e
     ``` 
    it will open file, paste code bellow and save it
    ``` 
      * * * * php {PATH_TO_PROJECT_DIRECTORY}/artisan schedule:run >> /dev/null 2>&1
     ``` 
    Replace {PATH_TO_PROJECT_DIRECTORY} with your path

13. Start application locally
    ``` 
      php artisan serve
     ``` 

14. Final step is to open running application at URL in browser
    ``` 
      http://localhost:8000/
     ``` 

## Project Structure

    .
    ├── app                                                 # Directory containing app resources
    │   ├── Classes                                         # Classes directory
    │   │   ├── Calculations                                # Contains methods used for calculations
    │   │   └── Rates                                       # Contains methods used to call external rate API
    │   ├── Console                                         # Directory containing Kernel
    │   │   └── Kernel                                      # Setup of scheduler for call Rates method
    │   ├── Events                                          # Directory containing OrderSaved event 
    │   │   └── OrderSaved                                  # Event triggered on order model
    │   ├── Fascades                                        # Directory containing Fascades for classes
    │   │   ├── Calculations                                # Calculations fascade
    │   │   └── Rates                                       # Rates fascade
    │   ├── Http                                            # Directory containing Fascades for classes
    │   │   ├── Controllers                                 # Controllers of an application
    │   │   │   ├── ActionsController                       # Controllers of actions
    │   │   │   ├── CalculationsController                  # Controllers of calculations
    │   │   │   ├── DiscountsController                     # Controllers of discounts
    │   │   │   ├── EmailsController                        # Controllers of emails
    │   │   │   ├── OrdersController                        # Controllers of orders
    │   │   │   ├── RatesController                         # Controllers of rates
    │   │   │   ├── SurchargesController                    # Controllers of surcharges
    │   │   │   └── WebAppController                        # Controllers of web app, contains view calls
    │   │   ├── Middleware                                  # Middleware layer of an applicaiton
    │   │   ├── Requests                                    # Holds custom requests with request validation rules
    │   │   │   ├── ActionsRequest                          # Custom actions request
    │   │   │   ├── CalculateRequest                        # Custom calculate request
    │   │   │   ├── DiscountsRequest                        # Custom discounts request
    │   │   │   ├── EmailsRequest                           # Custom emails request
    │   │   │   ├── OrdersRequest                           # Custom orders request
    │   │   │   ├── RatesRequest                            # Custom rates request
    │   │   │   ├── CalculateTotalRequest                   # Custom calculate total request
    │   │   │   ├── SurchargeAmountRequest                  # Custom surcharge amount request
    │   │   │   └── SurchargeRequest                        # Custom surcharge request
    │   │   ├── Kernel.php                                  # Http Kernel
    │   │   └── routes.php                                  # Routes of an application 
    │   ├── Listeners                                       # Controllers of an application
    │   │   └── TriggerActionsAfterOrderWasSaved            # Listener that is triggered after order is created,  logic
    │   ├── Models                                          # Directory containing Fascades for classes
    │   │   ├── Action                                      # Action model
    │   │   ├── Discount                                    # Discount model
    │   │   ├── Email                                       # Email model
    │   │   ├── ExchangedRate                               # ExchangedRate model
    │   │   ├── Order                                       # Order model
    │   │   └──  Surcharge                                  # Surcharge model
    │   ├── Providers                                       # Directory containing Fascades for classes
    │   │   ├── CalculationsServiceProvider                 # Service provider that injects calculations class
    │   │   ├── EventServiceProvider                        # Service provider that injects listener class and defines operation that trigger listener
    │   │   ├── ModelsServiceProvider                       # Service provider that injects Repository interfaces class
    │   │   └── RateServiceProvider                         # Service provider that injects rates class
    │   └──  Repositories                                   # Controllers of an application
    │           ├── Interfaces                              # Interfaces directory
    │           │   ├── ActionRepositoryInterface           # Action interface
    │           │   ├── DiscountRepositoryInterface         # Discount interface
    │           │   ├── EmailRepositoryInterface            # Email interface
    │           │   ├── OrderRepositoryInterface            # Order interface
    │           │   ├── RateRepositoryInterface             # Rate interface
    │           │   └── SurchargeRepositoryInterface        # Surcharge interface
    │           ├── DbActionRepository                      # Action repository contains logic for interaction with action model
    │           ├── DbDiscountRepository                    # Discount repository contains logic for interaction with discount model
    │           ├── DbEmailRepository                       # Email repository contains logic for interaction with email model
    │           ├── DbOrderRepository                       # Order repository contains logic for interaction with order model
    │           ├── DbRateRepository                        # Rate repository contains logic for interaction with rate model
    │           └── DbSurchargeRepository                   # Surcharge repository contains logic for interaction with surcharge model
    ├── database                                            # database folder contains migrations and seeds
    │   ├── migratons                                       # migrations directory contains table migrations
    │   └──  seeds                                          # seeds directory contains data seeds to table DatabaseSeeder contains config of table seeder
    ├── public                                              # public folder containing js files which are accessible for applicaiton
    │   └──  js                                             # contains angularjs, bootstrap, jquery and angular app file
    ├── resources                                           # database folder contains migrations and seeds
    │   ├── emails                                          # contains email templates
    │   └── views                                           # contains views for application
    │       ├── actions.blade.php                           # actions page
    │       ├── discounts.blade.php                         # discounts page
    │       ├── emails.blade.php                            # emails page
    │       ├── home.blade.php                              # index page of an application
    │       ├── orders.blade.php                            # orders page
    │       ├── rates.blade.php                             # rates page
    │       ├── surcharges.blade.php                        # surcharge page
    │       └── template.blade.php                          # template for other views 
    ├── .env                                                # enviroment parameters
    ├── bower.json                                          # holds bootstrap package
    ├── composer.json                                       # holds laravel packages        
    ├── gulpfile.js                                         # builds and compiles angularjs,bootstrap and copy it to public/js folder
    ├── package.json                                        # holds set of npm packages
    └── README.md                                           # Readme file
