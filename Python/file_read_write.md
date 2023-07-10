# Working with files

#### Load a file with a given file name and append a word
```
file_input = 'filename.xml'
file_input_name = file_input[::-1].split('.',1)[1][::-1]
file_input_ext = '.'+file_input[::-1].split('.',1)[0][::-1]
file_output = file_input_name+'_output'+file_input_ext
print('Input file: '+file_input)
print('Output file: '+file_output)
```

#### Write the input file to a variable
```
f = open(file_input, 'r', encoding='utf-8');
data = f.read()
print(data)
```

#### Write data to a file
```
output = open(file_output, 'w', encoding='utf-8')
output.write(data)
output.close()
```