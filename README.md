# flatsAPI
An API for storing and retrieving flats

The API is currently being tested on [nathanhollows.com/flats/](https://nathanhollows.com/flats/)

| Method | Url | Action |
|:------ |:--- |:------ |
| `GET`  | /api/flats | Retrives all current flats, sorted by date added |
| `POST` | /api/flats | Save a new listing. Returns the ID | 
| `GET`  | /api/flats/id/{id} | Retrieve a flat by ID |
| `DELETE` | /api/flats/id/{id} | Remove a flat from the listings |

Content type must be `application/x-www-form-urlencoded` (for now)

## Fields

| Value | Type | Default | Description |
|:----- |:---- |:------- | :---------- |
| id | string | UUID | An automatically generated UUID |
| price * | int | NULL | The cost per week |
| bedrooms * | int | NULL | |
| bedrooms * | int | NULL | |
| parking * | int | NULL | The number of off street parks |
| heroText * | string | NULL | Short description of listing. 100 char limit |
| description * | string | NULL | Description of listing |
| agent * | string | NULL | |
| image * | string | NULL | Image URL |
| url * | string | NULL | URL for listing |
| type * | string | NULL | To be decided |
| dateAdded | timestamp | NOW() | Derived when the listing was first added |
| dateAvailable | date | NOW() | When the listing is available |
| dateRemoved | timestamp | NULL | Derived when the listing was removed |
| pets * | int | 0 | `0`: False, `1`: True |
| address * | int | null | A string repesentation of the address |

**Note:** * Accepted in POST `/api/flats/`
