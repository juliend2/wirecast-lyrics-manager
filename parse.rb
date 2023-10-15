# Example usage:
#
# ruby parse.xml 'la force'
# > ... results ...

require 'rexml/document'
require 'json'
require 'base64'
require 'uri'

include REXML

file = File.new('messe.xml')
xmldoc = Document.new(file)

grep = ARGV.shift

grepped = []

grepped_title = 'NOT FOUND'
grepped_text = 'N/A'


shots = {}
XPath.each(xmldoc, '//shot') do |shot|
  #puts 'unique id'
  #puts shot['unique_id']
  unique_id = ''
  pp shot.elements['child']
#   XPath.each(shot, '//event/event') do |event|
#     unique_id = event['unique_id']
#     puts unique_id
#   end
#   if unique_id != ''
#     shot[ unique_id ] = shot['unique_id'] 
#   end
end
#pp shots

# XPath.each(xmldoc, "//source") do |source|
#   next if source['groupGUID'] != 'F091FF4F-1F10-4203-8854-05F8B0414BC0'
#   # FIXME:
#   source['unique_id'] # UUID that points to a <shot>,
#   title = source['prettyname'] # not good. it's the Name of the element containing the text
# 
#   text = ''
#   XPath.each(source, "xml_tag[@widget_settings]") do |ws|
#     json = JSON.parse(ws['widget_settings'])
#     enc = json['text']
#     if enc
#       plain = Base64.decode64(enc)
#       text = URI.decode(plain)
#       if text =~ /#{grep}/
#         puts source
#         grepped << {title: title, text: text}
#       end
#     end
#   end
# 
# end

# puts grepped.map{|g| g[:title] }

