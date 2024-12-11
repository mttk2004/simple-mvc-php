## Twig

_Twig is a powerful and flexible template engine for PHP. It allows you to separate your application's logic from its presentation, making your code more maintainable and easier to understand._
- [Twig Documentation](https://twig.symfony.com/doc/3.x/)

### Twig Syntax

#### Variables

- Variables in Twig are defined and accessed using double curly braces `{{ }}`.
- Example:

```twig
{{ name }}
```

#### Loops

- Loops in Twig are used to iterate over arrays or collections. They are defined using the `{% for %}` syntax.
- - Example:

```twig
{% for user in users %}
	{{ user.id }}
{% endfor %}
```

#### Conditionals

- Conditionals in Twig are used to execute code based on certain conditions. They are defined using the `{% if %}` syntax.
- Example:

```twig
{% if users is empty %}
	<p>No users found.</p>
{% else %}
	<p>Users found: {{ users|length }}</p>
{% endif %}
```

#### Includes

- The `{% include %}` tag is used to include a template within another template.
- Example:

```twig
{% include 'header.twig' %}
```

#### Extends

- The `{% extends %}` tag is used to extend a base template. This allows you to reuse a common layout across multiple templates.
- Example:

```twig
{% extends 'base.twig' %}
```

#### Filters

- Filters are used to modify the value of a variable. They are applied using the `|` syntax.
- Example:

```twig
{{ name|upper }}
```

#### Pagination

- Pagination in Twig is used to paginate over a collection of elements. It is defined using the `{% paginate %}` syntax.
- Example:

```twig
{% paginate elements as pageInfo, pageEntries %}
```

### Components Nesting

#### Using `{% include %}`

- `{% include %}` is used to include a template within another template.
- Example:

```twig
{% include 'header.twig' %}
```

#### Using `{% extends %}`

- `{% extends %}` is used to extend a template.
- Example:

```twig
{% extends 'base.twig' %}
```

#### Using `{% block %}`

- Blocks are used to define sections of a template that can be overridden by child templates. They are defined using the `{% block %}` syntax.
- Example:

```twig
{% block title %}
	<title>My Page</title>
{% endblock %}
```

#### Using `{% embed %}`

- `{% embed %}` is used to embed a template within another template.
- Example:

```twig
{% embed 'base.twig' %}
```
