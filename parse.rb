# encoding: utf-8

# Example usage:
#
# ruby parse.xml 'la force'
# > ... results ...

# require 'debug'
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


titles = {}
XPath.each(xmldoc, "//asset") do |asset|
  titles[asset['unique_id']] = asset['name']
end

XPath.each(xmldoc, "//source") do |source|
#   next if source['groupGUID'] != 'F091FF4F-1F10-4203-8854-05F8B0414BC0'
#   # FIXME:
   unique_id = source['unique_id'] # UUID that points to a <shot>,
   #title = source['prettyname'] # not good. it's the Name of the element containing the text
# 
   text = ''
   XPath.each(source, "xml_tag[@widget_settings]") do |ws|
     json = JSON.parse(ws['widget_settings'])
     enc = json['text']
     if enc
       plain = Base64.decode64(enc)
       text = URI.decode_www_form_component(plain)
       if text.force_encoding("utf-8") =~ /#{grep}/u
         # on trouve le calque dans le calque, mais ca prend son parent
          puts titles[unique_id]
#         puts source
#         grepped << {title: title, text: text}
       end
     end
   end
# 
end

#puts grepped.map{|g| g[:title] }

