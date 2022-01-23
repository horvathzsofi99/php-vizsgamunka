-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2022. Jan 23. 16:50
-- Kiszolgáló verziója: 10.4.21-MariaDB
-- PHP verzió: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `film`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `hozzaszolas` text NOT NULL,
  `datum` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `film_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `comment`
--

INSERT INTO `comment` (`id`, `hozzaszolas`, `datum`, `user_id`, `film_id`) VALUES
(1, 'Aranyos film', '2022-01-22', 7, 26),
(3, ':)', '2022-01-22', 3, 26),
(4, 'Igazi klasszikus! A zenéje is zseniális!', '2022-01-22', 6, 55),
(102, ':)', '2022-01-22', 6, 55),
(103, 'Ez egy nagyon jó film!', '2022-01-23', 7, 75);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `film`
--

CREATE TABLE `film` (
  `id` int(11) NOT NULL,
  `cim` varchar(255) NOT NULL,
  `kep_url` varchar(255) NOT NULL,
  `leiras` text NOT NULL,
  `kiadas_eve` year(4) NOT NULL,
  `ertekeles` int(11) NOT NULL,
  `torolve` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `film`
--

INSERT INTO `film` (`id`, `cim`, `kep_url`, `leiras`, `kiadas_eve`, `ertekeles`, `torolve`) VALUES
(1, 'Az öt legenda', 'az-ot-legenda.jpg', 'Vajon van Húsvéti Nyuszi? És Mikulás? És Fogtündér? És Homokember?\r\nHát persze! Vannak, amíg van gyermek, aki hisz bennük. Igen ám, de a gonosz Szurok azt szeretné, ha a gyermekek csak benne hinnének. Vagyis a mumusban. Ezért aztán az álmokból rémálmokat csinál, az örömből félelmet, a fényből sötétséget. Így az u201Cőrzőku201D, a gyermekálmok védelmezői nagy veszélybe kerülnek. Ám akad egy új segítségük, egy új őrző, Dér Jankó, az ötödik legenda.', 2012, 7, 'nem'),
(2, 'Családi üzelmek', 'csaladi-uzelmek.jpg', 'A dílereknek is vannak elveik. David (Jason Sudeikis) csak rászoruló családanyáknak vagy szorgos éttermi alkalmazottaknak árul, de gyerekeknek soha. És bízik benne, hogy ha mindig kispályás marad, nem érheti baj. De persze téved. Méghozzá nagyon nagyot.\r\nEgyszer, egyetlen egyszer néhány környékbeli kamasznak segít megszabadulni az elvonási tünetektől, azok erre kirabolják, és ő nem tud elszámolni sem az anyaggal, sem a pénzzel. Hogy jóvá tegye a hibáját kénytelen egy nagy szállítmányt áthozni Mexikóból. Szerencsére a jó szomszédja, egy cinikus sztriptíztáncosnő (Jennifer Aniston) és két züllött kiskorú (Emma Roberts, Will Poulter) segít neki: úgy tesznek, mintha családi túrán járnának, de a lakókocsi csempészáruval van tele. Az ötlet jó - a kivitelezés viszont elképesztő következményekkel jár...', 2013, 7, 'nem'),
(20, 'Életrevalók', 'eletrevalok.jpg', 'Ejtőernyős balesete után tolószékbe kerülve Philippe (Franu00E7ois Cluzet), a dúsgazdag arisztokrata felfogadja kisegítőnek Drisst (Omar Sy) a külvárosi gettóból jött férfit, aki nemrég szabadult a börtönből, és látszólag teljesen alkalmatlan az ilyen feladatokra. Két világ találkozik és ismeri meg egymást, és az őrült, vicces és meghatározó közös élmények nyomán kapcsolatukból meglepetésszerűen barátság lesz, amely szinte érinthetetlenné teszi őket a külvilág számára', 2011, 9, 'nem'),
(21, 'Női szervek', 'noi-szervek.jpg', 'Az FBI különleges ügynökei valóban különlegesek. Kemények, könyörtelenek, nincsenek barátaik. Sarah Ashburn (Sandra Bullock) közülük is kilóg: ő a cég legvadabb, legmagányosabb (és legrendezetlenebb magánéletű) embere. A kábítószer-maffia könyörtelen vezérének nyomában viszont kénytelen összefogni egy egyszerű bostoni zsaruval. A botrány garantált. Főleg azért, mert az egyszerű bostoni zsaru is nő (Melissa McCarthy), és történetesen legalább olyan kemény, olyan magányos és olyan goromba, mint Ashburn ügynök. Két ilyen kopó nem fér meg egy csárdában. De még egy városban sem.', 2013, 8, 'nem'),
(22, 'Nagyfiúk', 'nagyfiuk.jpg', 'Öt régi jó barát (Adam Sandler, Kevin James, Chris Rock, Rob Schneider és David Spade), akik gyermekkoruk óta nem látták egymást, egykori edzőjük temetésén, újra összehozza őket a sors. Felkerekednek hát feleségeikkel (Salma Hayek, Maria Bello, Maya Rudolph) és gyerekeikkel együtt, és a Függetlenség Napján elindulnak a hétvégi házban, ahol egykor a csapat sikereit ünnepelték együtt, ahol újra fiatalok lehetnek, ezúttal a csemetéikkel közösen. Hamarosan pedig rádöbbenek arra is, hogy attól, hogy öregebbek lettek, még koránt sem biztos, hogy fel is nőttek. A csapat most is a régi formáját hozza: a bulizás, egymás ugratása együtt a legjobb, hiszen a kor amúgy sem számít.', 2010, 7, 'nem'),
(23, 'Harmadik Shrek', 'harmadik-shrek.jpg', 'Nem mindenki akar király lenni - és ez különösen igaz behemót, mocsárbűzös ogrékra. Amikor Shrek feleségül vette Fionát, eszébe sem jutott, hogy egyszer Túl az Óperencián trónjára akarják majd ültetni. Ám apósa, az öreg Harold király váratlanul megbetegszik, és Shreket tekinti a trón várományosának. A birodalom húzódozó jövendő királya vagy talál maga helyett valaki mást a munkára, vagy élete hátralévő részét uralkodással kell töltenie. Mintha ez még nem volna elég, Fiona hercegnő is tartogat egy kis meglepetést Shrek számára. Shrek bepánikol az ország kormányzásával és az apasággal járó felelősségtől, és elhatározza, hogy felkutatja az egyetlen személyt, aki rajta kívül elfoglalhatja a trónt. Ő nem más, mint Fiona rég elveszett unokaöccse, Artie, egy középkori iskolakerülő. Amíg az ogre távol van, esküdt ellensége, a Szőke Herceg visszatér Túl az Óperenciánba, hogy elégtételt vegyen az őt ért sérelmekért. Shrek és Artie csak a szószátyár Szamár, a csalafinta Csizmás Kandúr és Fiona barátnői segítségével tudják legyőzni, hogy a film végére megint mindenki boldogan éljen...', 2007, 8, 'nem'),
(24, 'Rossz tanár', 'rossz-tanar.jpg', 'Elizabeth igazán utálja a munkáját, lusta, lógós, és a nagy lehetőségre vár, hogy maga mögött hagyja tanári pályáját. Többnyire filmet vetít a diákjainak, hogy addig se kelljen hozzájuk szólnia. Hirtelen azonban feltámad az életkedve, amikor a suliba érkezik az új helyettesítő tanár Justin Timberlake, aki nemcsak sármosabb az összes férfitanárnál, de állítólag jelentős vagyont is fog örökölni. A baj csak az, hogy az új tanerő egy másik tanárnővel Lucy Punch kezd randizni. Elizabeth azonban nem adja fel. Nem csak kiszemeltjét akarja meghódítani, hanem az iskolaversenyen is bizonyítani akar. Végre példát mutathat elszántságból, céltudatosságból, ravaszságból és gonoszságból. Az iskola fenekestől felfordul, és a tanári környékén eluralkodik a káosz.', 2011, 7, 'nem'),
(25, 'Annie', 'annie.jpg', 'Annie (Quvenzhané Wallis) árva, és élvezi. Nem mintha bármi vicces lenne az árvaházi mindennapokban: a gonosz főnéni (Cameron Diaz) legalább is mindent elkövet, hogy megkeserítse védtelen neveltjei életét. De a kislányok hada - és leginkább a cserfes, mókás, ötletekből kifogyhatatlan címszereplő - szerencsére mindig okosabb, gyorsabb, ravaszabb nála. A nevelőnő és az árvák közti háborúskodás talán sosem érne véget, ha Mr. Stacks (Jamie Foxx), a milliomos iparmágnás nem indulna a polgármester-választáson. Kampánya részeként kiválaszt egy árvát, magához veszi, és ha újságírót vagy fotóst lát a közelben azonnal igyekszik jó apaként viselkedni. Annie persze az új környezetében sem nyughat: igazságérzete és humorérzéke alaposan felforgatja az egyszerű pénzember mindennapjait - és olyan érzéseket kelt életre benne, amelyekről nem is tudta, hogy léteznek.', 2014, 6, 'nem'),
(26, 'A fiúknak - Örökkön örökké', 'a-fiuknak-orokkon-orokke.jpg', 'Miközben Lara Jean Covey a középiskola végére és a felnőttkor kezdetére készül, néhány sorsdöntő utazás arra sarkalja, hogy újragondolja ballagás utáni életét és a családjával, barátaival és Peterrel való kapcsolatát.', 2021, 7, 'nem'),
(27, 'Behavazott szívek', 'behavazott-szivek.jpg', 'Egy utazástól idegenkedő újságíró álmai megbízatását kergeti, amikor hamarosan azon kapja magát, hogy egy jóképű panziótulajdonost mentorál, aki pedig idegenvezető szeretne lenni.', 2021, 7, 'nem'),
(55, 'A nagy balhé', 'a-nagy-balhe-update.jpg', 'Johnny Hooker piti kis tolvaj, aki a társával együtt évek óta jól begyakorolt trükkel fosztogatja a gyanútlan járókelőket a harmincas években. Amikor véletlenül a maffia pénzszállítóját zsebelik ki, ez egyikük életébe kerül. A veszélyben forgó Johnny a befolyásos barátjához, Henry Gondorffhoz menekül. Arra kéri, segítsen neki bosszút állni a barátja gyilkosán. Gondorff és Hooker egy gondosan kidolgozott terv szerint húzza csőbe Doyle Lonnegant, a nagyhatalmú maffiafőnököt. A kolosszális átveréssel nemcsak bosszút állnak rajta, de az utolsó dollárjától is megszabadítják.', 1973, 8, 'nem'),
(56, 'Apád-anyád idejöjjön', 'apad-anyad-idejojjon.jpg', 'A nyári táborban vakációzó Hallie és Annie (Lindsay Lohan) megdöbbenve veszi tudomásul, hogy úgy hasonlítanak egymásra, mint egyik tojás a másikra. A két kislány némi ellenségeskedés után összebarátkozik, s hamarosan rájönnek, hogy testvérek, méghozzá ikrek, akiknek a szülei elváltak. Hamar megszületik a terv: helyet cserélnek és összehozzák szüleiket. A tervet azonban veszélyezteti a papa (Dennis Quaid) csinos és nagyravágyó barátnője.', 1998, 7, 'nem'),
(57, 'Avatar', 'avatar.jpg', 'Egy deréktól lefelé megbénult háborús veterán a távoli Pandorára utazik. A bolygó lakói, a Na`vik az emberhez hasonló faj - de nyelvük és kultúrájuk felfoghatatlanul különbözik a miénktől. Ebben a gyönyörű és halálos veszélyeket rejtő világban a földieknek nagyon nagy árat kell fizetniük a túlélésért.&#13;&#10;De nagyon nagy lehetőséghez is jutnak: a régi agyuk megőrzésével új testet ölthetnek, és az új testben, egy idegen lény szemével figyelhetik magukat és a körülöttük lévő felfoghatatlan, vad világot.&#13;&#10;A veterán azonban más céllal érkezett. Az új test új, titkos feladatot is jelent számára, amit mindenáron végre kell hajtania.', 2009, 8, 'nem'),
(58, 'Holiday', 'holiday.jpg', 'Két fiatal nő, két összetört szív. Iris reménytelenül szerelmes a kollégájába, akivel viszonyt folytat. Nem elég, hogy érzelmei viszonzatlanul maradnak, a férfi a karácsonyi bulin bejelenti, hogy eljegyezte az egyik kolléganőjüket. Eközben a munkamániás Amanda rájön, hogy a barátja megcsalja, ezért kiadja az útját. A két összetört szívű lány a világhálón akad egymásra. Miután kölcsönösen elsírják bánatukat, elhatározzák, hogy kipihenik megpróbáltatásaikat. Mivel az egyik Londonban, a másik pedig Los Angelesben él, kitalálják, hogy otthont cserélnek. A pasimentes vakáció nem a tervek szerint alakul.', 2006, 8, 'nem'),
(75, 'Förtelmes főnökök', 'fortelmes-fonokok.jpg', 'Dave Harken (Kevin Spacey) megalomán marketinges, Dr. Julia Harris (Jennifer Aniston) sze.mániás fogorvos, Bobby Pellitt (Colin Farrell) pedig mindent tönkretesz maga körül. Ők hárman a világ legutálatosabb főnökei. Kurt (Jason Sudeikis), Nick (Jason Bateman) és Dale (Charlie Day) a szenvedő alkalmazottak, akik felbérelik Jonest (Jamie Foxx) három piszkos munkára. Jones azonban csak tanácsadóként hajlandó közreműködni, és azt tanácsolja, egymás főnökeit tegyék el láb alól. Az amatőr banda a sorozatokból vett fogásokkal vág neki a feladatnak.', 2011, 8, 'nem');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kategoria`
--

CREATE TABLE `kategoria` (
  `id` int(11) NOT NULL,
  `megnevezes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `kategoria`
--

INSERT INTO `kategoria` (`id`, `megnevezes`) VALUES
(1, 'családi'),
(2, 'dokumentum'),
(3, 'dráma'),
(4, 'életrajzi'),
(5, 'fantasy'),
(6, 'háborús'),
(7, 'horror'),
(8, 'kaland'),
(9, 'krimi'),
(10, 'misztikus'),
(11, 'reality'),
(12, 'romantikus'),
(13, 'sci-fi'),
(14, 'sport'),
(15, 'thriller'),
(16, 'történelmi'),
(17, 'vígjáték'),
(18, 'western'),
(19, 'zenés'),
(20, 'akció'),
(21, 'animáció');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kategoria_film`
--

CREATE TABLE `kategoria_film` (
  `id` int(11) NOT NULL,
  `kategoria_id` int(11) NOT NULL,
  `film_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `kategoria_film`
--

INSERT INTO `kategoria_film` (`id`, `kategoria_id`, `film_id`) VALUES
(1, 1, 1),
(2, 5, 1),
(3, 8, 1),
(4, 21, 1),
(5, 9, 2),
(6, 17, 2),
(25, 17, 22),
(26, 1, 23),
(27, 21, 23),
(28, 17, 24),
(29, 1, 25),
(30, 19, 25),
(31, 3, 26),
(32, 12, 26),
(33, 17, 26),
(34, 12, 27),
(35, 17, 27),
(36, 9, 55),
(37, 3, 55),
(87, 1, 56),
(88, 8, 56),
(89, 12, 56),
(90, 17, 56),
(91, 5, 57),
(92, 20, 57),
(115, 17, 25),
(116, 12, 58),
(117, 17, 58),
(131, 17, 75);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `rendezo`
--

CREATE TABLE `rendezo` (
  `id` int(11) NOT NULL,
  `nev` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `rendezo`
--

INSERT INTO `rendezo` (`id`, `nev`) VALUES
(18, 'Eric Toledano'),
(19, 'Olivier Nakache'),
(21, 'Paul Feig'),
(22, 'Dennis Dugan'),
(23, 'Chris Miller'),
(24, 'Raman Hui'),
(25, 'Shana Feste'),
(26, 'Jake Kasdan'),
(27, 'Will Gluck'),
(28, 'Michael Fimognari'),
(29, 'Jeff Beesley'),
(30, 'William Joyce'),
(31, 'Peter Ramsey'),
(32, 'George Roy Hill'),
(33, 'Nancy Meyers'),
(34, 'James Cameron'),
(35, 'Seth Gordon');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `rendezo_film`
--

CREATE TABLE `rendezo_film` (
  `id` int(11) NOT NULL,
  `rendezo_id` int(11) NOT NULL,
  `film_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `rendezo_film`
--

INSERT INTO `rendezo_film` (`id`, `rendezo_id`, `film_id`) VALUES
(18, 18, 20),
(19, 19, 20),
(21, 21, 21),
(22, 22, 22),
(23, 23, 23),
(24, 24, 23),
(25, 25, 24),
(26, 26, 24),
(27, 27, 25),
(28, 28, 26),
(29, 29, 27),
(30, 30, 1),
(31, 31, 1),
(32, 32, 55),
(33, 33, 56),
(34, 34, 57),
(35, 33, 58),
(50, 35, 75);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `szinesz`
--

CREATE TABLE `szinesz` (
  `id` int(11) NOT NULL,
  `nev` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `szinesz`
--

INSERT INTO `szinesz` (`id`, `nev`) VALUES
(1, 'Jason Sudeikis'),
(20, 'Michael Rapaport'),
(21, 'Sandra Bullock'),
(22, 'Melissa McCarthy'),
(23, 'Thomas F. Wilson'),
(24, 'Nathan Corddry'),
(25, 'Kaitlin Olson'),
(26, 'Taran Killam'),
(1186, 'Salma Hayek'),
(1187, 'Adam Sandler'),
(1188, 'Kevin James'),
(1189, 'Chris Rock'),
(1190, 'David Spade'),
(1191, 'Rob Schneider'),
(1192, 'Antonio Banderas'),
(1193, 'Mike Myers'),
(1194, 'Eddie Murphy'),
(1195, 'Cameron Diaz'),
(1196, 'Lucy Punch'),
(1197, 'Cameron Diaz'),
(1198, 'Justin Timberlake'),
(1199, 'Jason Segel'),
(1200, 'Jamie Foxx'),
(1201, 'Quvenzhané Wallis'),
(1202, 'Rose Byrne'),
(1203, 'Lisa Durupt'),
(1204, 'Noah Centineo'),
(1205, 'Lana Condor'),
(1206, 'Janel Parrish'),
(1207, 'Madeleine Arthur'),
(1208, 'Sarayu Blue'),
(1209, 'Rodrigo Beilfuss'),
(1210, 'Jen Lilley'),
(1211, 'Chris McNally'),
(1212, 'Amy Groening'),
(1220, 'Jude Law'),
(1221, 'Alec Baldwin'),
(1222, 'Robert Redford'),
(1223, 'Paul Newman'),
(1224, 'Robert Shaw'),
(1225, 'Dennis Quaid'),
(1226, 'Lindsay Lohan'),
(1227, 'Stephen Lang'),
(1228, 'Sam Worthington'),
(1229, 'Sigourney Weaver'),
(1230, 'Zoe Saldana'),
(1231, 'Cameron Diaz'),
(1232, 'Kate Winslet'),
(1439, 'Jennifer Aniston'),
(1440, 'Jason Bateman'),
(1441, 'Charlie Day');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `szinesz_film`
--

CREATE TABLE `szinesz_film` (
  `id` int(11) NOT NULL,
  `szinesz_id` int(11) NOT NULL,
  `film_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `szinesz_film`
--

INSERT INTO `szinesz_film` (`id`, `szinesz_id`, `film_id`) VALUES
(1, 1, 2),
(1185, 1186, 22),
(1186, 1187, 22),
(1187, 1188, 22),
(1188, 1189, 22),
(1189, 1190, 22),
(1190, 1191, 22),
(1191, 1192, 23),
(1192, 1193, 23),
(1193, 1194, 23),
(1194, 1195, 23),
(1195, 1196, 24),
(1196, 1197, 24),
(1197, 1198, 24),
(1198, 1199, 24),
(1199, 1195, 25),
(1200, 1200, 25),
(1201, 1201, 25),
(1202, 1202, 25),
(1203, 1203, 26),
(1204, 1204, 26),
(1205, 1205, 26),
(1206, 1206, 26),
(1207, 1207, 26),
(1208, 1208, 26),
(1209, 1209, 27),
(1210, 1210, 27),
(1211, 1211, 27),
(1212, 1212, 27),
(1234, 1220, 1),
(1235, 1221, 1),
(1236, 1222, 55),
(1237, 1223, 55),
(1238, 1224, 55),
(1239, 1225, 56),
(1240, 1226, 56),
(1241, 1227, 57),
(1242, 1228, 57),
(1243, 1229, 57),
(1244, 1230, 57),
(1245, 1195, 58),
(1246, 1197, 58),
(1247, 1220, 58),
(1248, 1231, 58),
(1249, 1232, 58),
(1526, 1440, 75),
(1527, 1441, 75),
(1528, 1, 75),
(1529, 1439, 75);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `jelszo` varchar(255) NOT NULL,
  `nev` varchar(255) NOT NULL,
  `szuletesi_datum` date NOT NULL,
  `kep_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `user`
--

INSERT INTO `user` (`id`, `email`, `jelszo`, `nev`, `szuletesi_datum`, `kep_url`) VALUES
(1, 'teszt@email.com', 'E54EE7E285FBB0275279143ABC4C554E5314E7B417ECAC83A5984A964FACBAAD68866A2841C3E83DDF125A2985566261C4014F9F960EC60253AEBCDA9513A9B4', 'Teszt Elek', '2002-01-16', ''),
(2, 'gcubd@nisn.vs', '9c6d7952755415c26ff3c5dc3cc1ee281b56c8542c8619e1d5133a49387d9b26deab3d0d140849a84ca8d13b34cca329af6878ab27d505ccccd473b3a7c56c2a', 'Minta Móni', '1999-04-29', 'img4.png'),
(3, 'kis.pisti@email.com', '81fbf929a6196fae3564d34457b0f2f74345786f9fc3a762039f57e8d47f5f8a612e61a96f33ee165414de36e7ab0d2615667a7636ae5d598b5afb25ce87c0b4', 'Kis Pista', '1998-02-06', 'img2.png'),
(4, 'hti.hozsa@gmail.com', '748153af450e2e7b133560212368401417bbada4f6a3c6ed7d0102411ae40418606c8c024ca66c9b66de23c59389a2d96173f4252c5409412c323c901ebff5e7', 'Takács Ibolya', '1964-11-12', 'img19.png'),
(5, 'herendizso@gmail.com', '88bf89a0520df5dae553539572324cd4bc4f95ae6044dd7c909f112afa254541b97893db6179810776aff451d824211ec93b7b5f392d83a362a5f12011270fc4', 'Herendi Zsó', '1996-05-30', 'img4.png'),
(6, 'herman.otto@email.com', '81fbf929a6196fae3564d34457b0f2f74345786f9fc3a762039f57e8d47f5f8a612e61a96f33ee165414de36e7ab0d2615667a7636ae5d598b5afb25ce87c0b4', 'Herman Ottó', '1835-06-26', 'img12.png'),
(7, 'apetofisandor@email.hu', '81fbf929a6196fae3564d34457b0f2f74345786f9fc3a762039f57e8d47f5f8a612e61a96f33ee165414de36e7ab0d2615667a7636ae5d598b5afb25ce87c0b4', 'Petőfi Sándor', '1823-01-01', 'img7.png');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `film_id` (`film_id`);

--
-- A tábla indexei `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `kategoria`
--
ALTER TABLE `kategoria`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `kategoria_film`
--
ALTER TABLE `kategoria_film`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategoria_id` (`kategoria_id`),
  ADD KEY `film_id` (`film_id`);

--
-- A tábla indexei `rendezo`
--
ALTER TABLE `rendezo`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `rendezo_film`
--
ALTER TABLE `rendezo_film`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rendezo_id` (`rendezo_id`),
  ADD KEY `film_id` (`film_id`);

--
-- A tábla indexei `szinesz`
--
ALTER TABLE `szinesz`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `szinesz_film`
--
ALTER TABLE `szinesz_film`
  ADD PRIMARY KEY (`id`),
  ADD KEY `szinesz_id` (`szinesz_id`),
  ADD KEY `film_id` (`film_id`);

--
-- A tábla indexei `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT a táblához `film`
--
ALTER TABLE `film`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT a táblához `kategoria`
--
ALTER TABLE `kategoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT a táblához `kategoria_film`
--
ALTER TABLE `kategoria_film`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT a táblához `rendezo`
--
ALTER TABLE `rendezo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT a táblához `rendezo_film`
--
ALTER TABLE `rendezo_film`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT a táblához `szinesz`
--
ALTER TABLE `szinesz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1442;

--
-- AUTO_INCREMENT a táblához `szinesz_film`
--
ALTER TABLE `szinesz_film`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1530;

--
-- AUTO_INCREMENT a táblához `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`film_id`) REFERENCES `film` (`id`);

--
-- Megkötések a táblához `kategoria_film`
--
ALTER TABLE `kategoria_film`
  ADD CONSTRAINT `kategoria_film_ibfk_1` FOREIGN KEY (`film_id`) REFERENCES `film` (`id`),
  ADD CONSTRAINT `kategoria_film_ibfk_2` FOREIGN KEY (`kategoria_id`) REFERENCES `kategoria` (`id`);

--
-- Megkötések a táblához `rendezo_film`
--
ALTER TABLE `rendezo_film`
  ADD CONSTRAINT `rendezo_film_ibfk_1` FOREIGN KEY (`film_id`) REFERENCES `film` (`id`),
  ADD CONSTRAINT `rendezo_film_ibfk_2` FOREIGN KEY (`rendezo_id`) REFERENCES `rendezo` (`id`);

--
-- Megkötések a táblához `szinesz_film`
--
ALTER TABLE `szinesz_film`
  ADD CONSTRAINT `szinesz_film_ibfk_1` FOREIGN KEY (`film_id`) REFERENCES `film` (`id`),
  ADD CONSTRAINT `szinesz_film_ibfk_2` FOREIGN KEY (`szinesz_id`) REFERENCES `szinesz` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
