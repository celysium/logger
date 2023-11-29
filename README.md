# Logger 

## Log Http Request,Response,Exception
### for store http request and response into collection request_log in mongo db use macro loggable


**before:**
``` 
Http::withBasicAuth(env('USERNAME'), env('PASSWORD'))            
            ->withHeaders(
                [
                    'Accept'           => 'application/json',
                    'Content-Type'     => 'application/json',
                ]
            )
            ->baseUrl(env('BASE_URL'))
            ->get('')
            ->onError(function ($response) {
                throw new BadRequestHttpException($response);
            })
            ->json();
```
**after:**
```
Http::loggable('name')->withBasicAuth(env('USERNAME'), env('PASSWORD'))            
            ->withHeaders(
                [
                    'Accept'           => 'application/json',
                    'Content-Type'     => 'application/json',
                ]
            )
            ->baseUrl(env('BASE_URL'))
            ->get('')
            ->onError(function ($response) {
                throw new BadRequestHttpException($response);
            })
            ->json();
```
