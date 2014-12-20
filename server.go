package main

import (
  "github.com/go-martini/martini"
  "github.com/martini-contrib/render"
  "encoding/json"
  "fmt"
  "io/ioutil"
  "net/http"
  "net/url"
)

///////////////////
// API Constants //
///////////////////
const ApiKey = "75e821c10fe1bf8fc45ae3f2c008b7d1"
const ApiRoot = "https://api.themoviedb.org/3"

//////////////////
// Data structs //
//////////////////
type Movie struct {
  ID        int     `json:"id"`
  Title     string  `json:"title"`
  Overview  string  `json:"overview"`
  Poster    string  `json:"poster_path"`
  Backdrop  string  `json:"backdrop_path"`
}

type SearchResults struct {
  Page          int     `json:"page"`
  TotalPages    int     `json:"total_pages"`
  TotalResults  int     `json:"total_results"`
  Results       []Movie `json:"results"`
}

/////////////////////
// handle requests //
/////////////////////
func breakError(err error){
  if err != nil {
    panic(err)
  }
}
func doRequest(uri string) []byte {
  res, err := http.Get(ApiRoot + uri)
  breakError(err)
  defer res.Body.Close()
  body, err := ioutil.ReadAll(res.Body)
  breakError(err)
  return body
}

/////////////////////////////////
// Do Request with struct type //
/////////////////////////////////
func getResults(uri string) *SearchResults {
  body := doRequest(uri)
  results := new(SearchResults)
  err := json.Unmarshal(body, results)
  breakError(err)
  return results
}
func getMovie(id string) *Movie {
  uri := fmt.Sprintf("/movie/%s?api_key=%s", id, ApiKey)
  body := doRequest(uri)
  movie := new(Movie)
  err := json.Unmarshal(body, movie)
  breakError(err)
  return movie
}

//////////////////////
// Fetch movie data //
//////////////////////
func fetchMovies(query string) *SearchResults {
  uri := ""
  if(query != ""){
    query = url.QueryEscape(query)
    uri = fmt.Sprintf("/search/movie?api_key=%s&include_adult=false&query=%s", ApiKey, query)
  }else{
    uri = fmt.Sprintf("/movie/popular?api_key=%s", ApiKey)
  }
  return getResults(uri)
}
func fetchMovie(id string) *Movie {
  id = url.QueryEscape(id)
  return getMovie(id)
}

///////////////////
// Martini stuff //
///////////////////
func main() {
  m := martini.Classic()
  m.Use(render.Renderer(render.Options{
    Layout: "layout",
  }))

  m.Get("/search", func(req *http.Request, r render.Render) {
    qs := req.URL.Query()
    results := fetchMovies(qs.Get("query"))
    r.HTML(200, "results", results)
  })

  m.Get("/movie/:movieId", func(params martini.Params, r render.Render) {
    movie := fetchMovie(params["movieId"])
    r.HTML(200, "movie", movie)
  })

  m.Get("/", func(r render.Render) {
    results := fetchMovies("")
    r.HTML(200, "results", results)
  })

  m.Run()
}
