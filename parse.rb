require 'rexml/document'
require 'json'
require 'base64'
require 'uri'

include REXML

file = File.new('messe.xml')
xmldoc = Document.new(file)

XPath.each(xmldoc, "//source/xml_tag[@widget_settings]") do |source|
  enc = JSON.parse(source['widget_settings'])['text']
  if enc
    plain = Base64.decode64(enc)
    text = URI.decode(plain)
    puts text
  end
end
