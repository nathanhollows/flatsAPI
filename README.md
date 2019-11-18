# flatsAPI
An API for storing and retrieving flats

The API is currently being tested on [nathanhollows.com/flats/](https://nathanhollows.com/flats/)

| Method | Url | Action |
|:------ |:--- |:------ |
| `GET`  | /api/flats | Retrives all current flats, sorted by date added |
| `GET`  | /api/flats/id/{id} | Retrieve a flat by ID |
| `DELETE` | /api/flats/id/{id} | Remove a flat from the listings |
