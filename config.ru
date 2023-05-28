require 'sinatra'

get '/' do
  erb :index
end

post '/change-text' do
  basename = params[:basename]
  puts basename.inspect
  redirect '/'
end

