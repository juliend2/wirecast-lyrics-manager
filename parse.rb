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

XPath.each(xmldoc, "//source") do |source|
  next if source['groupGUID'] != 'F091FF4F-1F10-4203-8854-05F8B0414BC0'
  title = source['prettyname']
  text = ''
  XPath.each(source, "xml_tag[@widget_settings]") do |ws|
    json = JSON.parse(ws['widget_settings'])
    enc = json['text']
    if enc
      plain = Base64.decode64(enc)
      text = URI.decode(plain)
      if text =~ /#{grep}/
        grepped << {title: title, text: text}
      end
    end
  end

end

puts grepped.map{|g| g[:title] }

