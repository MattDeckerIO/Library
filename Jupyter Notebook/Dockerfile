FROM quay.io/jupyter/minimal-notebook

RUN pip3 install beautifulsoup4 xmltodict lxml

EXPOSE 8888

ENTRYPOINT ["jupyter", "notebook", "--no-browser","--NotebookApp.token=''","--NotebookApp.password=''"]
