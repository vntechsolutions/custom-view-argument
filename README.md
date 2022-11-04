## The problem 

If you have two alias urls, for example example/products/product-a and example/product/product-b and now you want to have view page that have url example/products/product-a/product-b using Views Contextual Filters OR.
While contextual filter can work for example/products/8/11 (8 and 11 correspond to products/product-a and products/product-b respectively) it doesn't work for url alias generated from pathauto, example/products/product-a/product-b

## The solution

Chris4783 suggested to create a custom ViewsArgumentValidator and transform the given alias to the Node ID, so the contextual can filter according to the given alias url.
Read more: https://drupal.stackexchange.com/questions/311415/use-path-alias-as-contextual-filter
