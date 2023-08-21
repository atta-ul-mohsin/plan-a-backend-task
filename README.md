# Plan A Backend Coding Task
## Task

----------
> Let's say that we have a data collection system that requires the creation of models (entities) dynamically based on some csv files provided by the customers. We need to write a template parser that takes an array like the one below, with the type of data collection, and generates a model (entity) class file with the name of the file and path, class name, namespace and table name based on the params in the
> ```php
> array: 
> [ 
>   'scope' => [ 'indirect-emissions-owned', 'electricity', ],
>   'name' => 'meeting-rooms', 
> ] 
> ```
>  In this case, the name and the path of the file to be created should be: 
> ```php
> Models/IndirectEmissionsOwned/Electricity/MeetingRooms.php 
> ```
> The namespace should be: 
> ```php
> App\Models\IndirectEmissionsOwned\Electricity 
> ```
> The name of the class should be: 
> ```php
> MeetingRooms 
> ```
> The name of the table should be: 
> ```php
> meeting-rooms 
> ```
> And this is the template we should parse:
> ```php
> <?php 
> namespace {namespace}; 
> 
> use Illuminate\Database\Eloquent\Model; 
> 
> class {class_name} extends Model 
> { 
>   const TABLE_NAME = {table_name}; 
>   public function getTableName(): string 
>   { 
>       return self::TABLE_NAME; 
>   } 
> } 
> ```
> This task shouldn't take more than 3 hours. 
> Please let us know how long it takes you so we can improve it. 
> You don't need to write any presentation layer, just the code to process the parameters, parse the template, and generate the file, as well as the unit tests.
>
---------------------
## Solution

---------------------
## Installation

To get started with this project, follow these steps:

1. **Clone the Repository:**

```console
 git clone https://github.com/atta-ul-mohsin/plan-a-backend-task.git
```

2. **Navigate to the Project Directory:**

```console
cd plan-a-backend-task
```

3. **Install Dependencies:**
```console
composer install
```
This will install the required PHP dependencies, including PHPUnit for testing.

## Usage

After successfully installing the project, you can use it as follows:

### Run the Main Application

To run the main application and perform the desired functionality:

```console
php main.php
```

### Testing

To run the unit tests for the project:

```console
composer test
```

This command will execute PHPUnit and run all the tests located in the \`tests/\` directory.
