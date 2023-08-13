require 'rexml/document'
puts 'joie'

include REXML

file = File.new('messe.xml')
xmldoc = Document.new(file)

XPath.each(xmldoc, "//source") do |source|
  puts source
end
