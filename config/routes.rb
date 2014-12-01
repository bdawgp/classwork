Rails.application.routes.draw do
  resources :posts

  devise_for :users
  root 'pages#index'
  resources :pages
end
