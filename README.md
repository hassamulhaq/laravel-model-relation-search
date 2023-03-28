## Laravel Model and Model Relation Search
Laravel package to search via your models and model relations.

installation :

`composer required hassamulhaq/laravel-model-relation-search`


Usage :

- Use `ModelRelationSearchableTrait` trait in your model.
- Define `$searchable_columns` property in your model to select which columns to search in.

Example :

```php  
use HassamUlHaq\LaravelModelRelationSearch\ModelRelationSearchableTrait;

class Book extends Model
{
  use ModelRelationSearchableTrait;
  
  protected $searchable_columns = [
    'title',
    'author.bio',
    //'author.companies.name'
  ];
  
  public function authors()
  {
    return $this->hasOne(Author::class);
  }
