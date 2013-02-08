# EE Base Module

A simple base module for EE, on which a full module can be built.

You will want to replace the existing module name in the files,
as well as renaming the files themselves, before developing your
own module.

[mmv](http://linux.die.net/man/1/mmv) is useful for changing the
filenames easily, using something like:

```bash
mmv ";*module_base*.php" "#1#2my_module#3.php"
```
