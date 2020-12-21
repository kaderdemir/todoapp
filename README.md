# todoapp
#todolist
Task : To-Do Planning,
Açıklama :
2 ayrı provider'dan gelecek to-do iş bilgilerini çekerek development ekibine haftalık olarak
paylaştıracak ve ekrana çıktısını verecek bir web uygulama geliştirme.
Her provider servisinde task ismi, süre (saat olarak), zorluk derecesi vermektedir. Toplam 5
developer var ve her developer’ın 1 saatte yapabildiği iş büyüklüğü aşağıda verildiği gibidir:

Developer Süre Zorluk
DEV1       1h   1x
DEV2       1h   2x
DEV3       1h   3x
DEV4       1h   4x
DEV5       1h   5x

Developer’ların haftalık 45 saat çalıştığı varsayılarak, en kısa sürede işlerin bitmesini sağlayan
bir algoritma ile haftalık developer bazında iş yapma programını ve işin minimum toplam kaç haftada
biteceğini ekrana basacak bir ara yüz hazırlanmalı.
Koşullar :
· Programlama dili olarak PHP ve Framework olarak Symfony 4 tercih edilmeli. (Yetkin olduğun farklı
bir framework tercih edebilirsin.)
· 2 ayrı to-do iş listesi veren API'lerden (aşağıda mock server yanıtlarını bulabilirsin.) iş listesi
çekilecek.
· Burada iş listesini veren servisler Design Pattern ile geliştirilmeli ki daha sonra 3. bir iş listesi veren
API'nin eklenmesi gerekirse (Provider 3) bu sadece API tanıtımı ile yapılabilsin.
· Bu verileri API’lerden çekmek için command (console) yazılacak ve veri tabanına kaydedecek. Ana
sayfada veri tabanından okuduğu verilerle planlama sonucunu çıkartıp verileri gösterecek. İhtiyaç
halinde ön yüzde Bootstrap ve Jquery vb. kullanılabilir.
· Backend servisinde Facade, Factory, Proxy, Strategy veya Adapter vb. gibi patternleri ile geliştirme
yapılması tercih edilir.

Provider 1:
http://www.mocky.io/v2/5d47f24c330000623fa3ebfa
Provider 2:
http://www.mocky.io/v2/5d47f235330000623fa3ebf7
