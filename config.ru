require 'sinatra'

get '/' do
  erb :index
end

post '/change-text' do
  basename = params[:basename]
  puts basename.inspect
  content = File.open("./textes/#{basename}").read
  File.write("./current.txt", content)
  redirect '/'
end

