# S3 Uploads Cache

This plugin is a caching extension to [S3 Uploads](https://github.com/humanmade/S3-Uploads) plugin. By default, [S3 Uploads](https://github.com/humanmade/S3-Uploads), registers `s3` stream wrapper that takes care about accessing `s3` based filed for operations such as `filesize`, `file_exists` and others. This allows developer operate on `s3` assets like they were stored locally.

In many cases, [S3 Uploads](https://github.com/humanmade/S3-Uploads) plugin is used to offload images to AWS S3 and data uploaded there is not changing often or at all. In systems with high traffic a continous access to AWS S3 API is not really required and leads to performance degradation (I have observed that sometimes AWS S3 API interaction via [S3 Uploads](https://github.com/humanmade/S3-Uploads) `s3` stream wrapper is about 13%-15% of entire execution time).

AWS S3 StreamWrapper class offers caching support by passing to it a class that implements `\Aws\CachingInterface`. With this support this plugin leverages WordPress object cache to store S3 objects metadata and technically it reduces AWS S3 API interaction to minimum.

This plugin was tested up to: 2.0.1 of [S3 Uploads](https://github.com/humanmade/S3-Uploads) 
