Intregação da api zoom com php. 

Para ulitizar esta api será necessário possuir uma chave key e uma chave secrecet.
Você deve criar uma conta no zoom para possuir tais chaves.

Ao iniciar a classe você deve informar o api key e o api secret para gerar sua assinatura.

Ex:

$zoom = new zoom("minhakey", "minhasecret");
Desta maneira será iniciado o zoom corretamente e será possível gerar a assinatura.

O zoom possui metódos de utilização os metodos são 

Create()



metodo create é usado para criar reunião 

deve passar creata(nome da reunião, hora da reunião(2021-04-25T20:15:10))
Neste exemplo o nome da reunião ficou nome da reunião e será feito a reunião no dia 25 do 04 de 2021 as 20:15:10


Metódo meeting em construção....