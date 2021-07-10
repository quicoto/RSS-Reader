# Changelog

## 1.1.2

- When deleting old items always leave the last 10. We usually fetch 10 at a time, so we make sure we don't re-add them on each fetch.

## 1.1.1

- Add new param to the insert new feed

## 1.1.0

- Add a "last fetched url" so we can safely remove read items (via cronjob or otherwise) without fear of re-fetching already fetched items.

## 1.0.4

- Fix encoding of titles
