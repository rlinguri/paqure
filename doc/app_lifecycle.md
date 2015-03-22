### Application Lifecycle ###

The application can be initialized in a bootstrapper by instantiating an App Controller with the command:

```php
$app = new AppCtl();
 ```

After running the ```date_default_timezone_set(DEFINE_THIS_IN_CFG.PHP);``` command, the model property is set with a new Application Model instance:

```php
$this->mdl = new AppMdl();
```
The Model opens a database connection and sets the table name.

---
The controller then instantiates the Application Object Singleton with:

```php
$obj = AppObj::obj();
```

The singleton's **oid** (object identifier) and **tim** (time) properties are then populated with a callback to the Model's ini() method, which returns an array:

```php
$obj->ini($this->mdl->newRec());
```

The **oid** property is a primary key, or basically a serial number, which will be associated with all objects created during the course of the lifecycle.

The application singleton's **prs** (parse), **qry** (query) and **rpl** (reply) objects represent the phases of the application lifecycle and are populated by calling the controllers for each class:

