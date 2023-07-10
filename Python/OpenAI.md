# Parse data with OpenAI

```
# Note: The openai-python library support for Azure OpenAI is in preview.
# pip3 install openai
import os
import openai

# pip3 install python-decouple
# https://able.bio/rhett/how-to-set-and-get-environment-variables-in-python--274rgt5
from decouple import config

def ai_parse(s):
#     return 'Written by OpenAI'
    promptHeader = 'Do awesome stuff to the following:\n\n'
    openai.api_type = "azure"
    openai.api_base = "https://YOUR-PATH-TO-AZURE-OPENAI.openai.azure.com/"
    openai.api_version = "2022-12-01"
    openai.api_key = config('OPENAI_API_KEY')

    response = openai.Completion.create(
      engine="text-davinci-003",
      prompt=promptHeader+s,
      temperature=0,
      max_tokens=300,
      top_p=1,
      frequency_penalty=0,
      presence_penalty=0,
      best_of=1,
      stop=None)

    return response["choices"][0]["text"].strip()
```