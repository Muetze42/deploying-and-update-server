<x-mail::message>
# Publish failed

The {{ $release->version }} release of the {{ $release->app->name }} app was not published.

## VirusTotal Stats

```
{!! jsonPrettyEncode($release->virus_total_stats) !!}
```

<br>
{{ config('app.name') }}
</x-mail::message>
