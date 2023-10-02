<x-mail::message>
# Publish Successful

The {{ $release->version }} release of the {{ $release->app->name }} app has been published.

## VirusTotal Stats

```
{!! jsonPrettyEncode($release->virus_total_stats) !!}
```

<br>
{{ config('app.name') }}
</x-mail::message>
