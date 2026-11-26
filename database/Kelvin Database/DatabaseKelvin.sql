--------------------------------------
--Insert into medewerker

--------------------------------------
INSERT INTO Medewerker
(PraktijkmanagmentId, Naam, Functie, Email, Wachtwoord, Isactief)
VALUES
(1, 'Jan Jansen', 'Tandarts', 'jan@smilepro.nl', 'test123', 1),
(1, 'Lisa de Vries', 'Mondhygiënist', 'lisa@smilepro.nl', 'test123', 1),
(1, 'Pieter Bakker', 'Tandartsassistent', 'pieter@smilepro.nl', 'test123', 1),
(2, 'Sophie Visser', 'Administratief medewerker', 'sophie@smilepro.nl', 'test123', 1),
(2, 'Mark Smit', 'Tandarts', 'mark@smilepro.nl', 'test123', 1);

--------------------------------------
--Insert into praktijkmanagment

--------------------------------------

INSERT INTO Praktijkmanagment
(Beschikbaarheid, IsActief, Opmerkingen)
VALUES
('Maandag t/m vrijdag 08:00-17:00', 1, 'SmilePro praktijk');