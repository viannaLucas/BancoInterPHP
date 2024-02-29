<?PHP

namespace viannaLucas\BancoInterPhp\Test\OAuth\TokenPersistence;

use PHPUnit\Framework\TestCase;
use Exception;
use viannaLucas\BancoInterPhp\OAuth\Token;
use viannaLucas\BancoInterPhp\OAuth\TokenPersistence\FileTokenPesistence;
use viannaLucas\BancoInterPhp\Test\DataProvider;



final class FileTokenPesistenceTest extends TestCase
{
    
    protected string $pathFile = __DIR__."/../../../";
    protected string $nameFile = 'TokenPersistenceFile.obj';
    
    public function testCanSaveAndLoadFile(): void
    {
        
        if(is_file($this->pathFile.$this->nameFile)){
            unlink($this->pathFile.$this->nameFile);
        }
        if(!is_writable($this->pathFile)){
            throw new Exception('Folder isn\'t writable: '.realpath($this->pathFile));
        }
        $persistenceFile = new FileTokenPesistence($this->pathFile.$this->nameFile);
        
        $expired = random_int(1, 2) == 1;
        $token = DataProvider::token($expired);
        $this->assertEquals(true, $persistenceFile->saveToken($token), 'Error save file!');
        
        $tokenLoaded = $persistenceFile->loadToken();
        $this->assertEquals(true, $tokenLoaded instanceof Token, 'Error loading file...');
        
        if(is_file($this->pathFile.$this->nameFile)){
            unlink($this->pathFile.$this->nameFile);
        }
    }
}