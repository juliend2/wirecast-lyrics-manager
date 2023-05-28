require 'sinatra'

get '/' do
  erb :index
end

post '/change-text' do
  basename = params[:basename]
  puts basename.inspect
  # TODO: create a file in the current directory, that will hold the currently
  # selected text.
  # TODO: use the basename to get the file from ./textes/* and put it in the
  # current file, for it to be replaced.
  redirect '/'
end

