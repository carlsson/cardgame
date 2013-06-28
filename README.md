Starta med:

    % php main.php

Med xmlformatering (kräver xmllint: apt-get install libxml2-utils):

    % php main.php | xmllint --format -

Testa med phpunit (kör från rootkatalogen):

    % phpunit --verbose tests
