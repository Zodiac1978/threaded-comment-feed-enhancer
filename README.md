threaded-comment-feed-enhancer
==============================

A simple plugin which enhances comment text of threaded comments in the feed with the text ```(This is a reply to the <a href='LINK'>comment</a> from AUTHOR_FROM_COMMENT.)``` to be less confusing for comment feed readers if someone is replying to an earlier comment.

## Why?

Imagine this in your feed reader:
```
Comment #1: WordCamp Miami was awesome!
Comment #2: I do not learn anything. It was boring ... :(
Comment #3: YES, it was!
```

But Comment #3 is a reply to Comment #1. But we don't see it.

With this plugin you get something like that:
```
Comment #1: WordCamp Miami was awesome!
Comment #2: I do not learn anything. It was boring ... :(
Comment #3: (This is a reply to the comment from Comment #1.) YES, it was!
```

## Thanks

* Dominik Schilling (@ocean90)
* Thomas Scholz (@toscho)
* Frank Bültge (@bueltge)

## License

This plugin is licensed under GPLv3.

## Usage

Just upload the plugin and activate it. Done!