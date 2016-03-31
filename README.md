# Arcanist linter and engine skeletons

This skeletons help to create own linter or engine.


## Linter skeleton

Add a linter to .arclint.

```
{
  "linters": {
    "skeleton": {
      "type": "skeleton",
      "version": "1"
    }
  }
}
```


## Engine skeleton

Load engine in .arcconfig configuration file.

```
{
  "project_id": "project_id",
  "load": [
        "skeleton"
  ],
  "unit.engine": "SkeletonTestEngine"
}
```

You can use two or more engines with https://github.com/tagview/arcanist-extensions#multi_test_engine extension in phabricator.
