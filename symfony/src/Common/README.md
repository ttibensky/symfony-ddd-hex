# Common

`Common` domain package contains functionality that is heavily reused accross other domain packages.

If you find a case where two or more domain packages need to be depending on each other, it might be tempting to put that functionality into `Common` domain package.
While it makes sense for things like Paginator or Error logging, it is in general not a good idea to put business related functionality here even if you needed to create a dependency between other domain packages.
