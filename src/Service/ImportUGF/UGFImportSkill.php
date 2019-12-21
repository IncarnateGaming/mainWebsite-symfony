<?php


namespace App\Service\ImportUGF;


use App\Entity\IncarnateSkill;

class UGFImportSkill extends BaseUGFImporter
{
    public function import(){
        $skillRepository = $this->em->getRepository(IncarnateSkill::class);
        $skillRepository->deleteAll()->getQuery()->execute();
        foreach ($this->ugf->chapters->skillsChapter->skills->skill as $skill) {
            $new = new IncarnateSkill();
//            $new->setLegal();
            $new->setOfficial($skill->officialContent->__toString()=='true'?true:false);
            $new->setAuthor($skill->author->__toString());
            $new->setUgfid($skill['skillID']);
            $new->setName($skill->skillName->__toString());
            $new->setDescription($this->functions->formatParagraphs($skill->skillDescription));
            $new->setType($this->incImportType['skill']);
            $new->setFid($skill['FID']);
            $new->setAbility($skill->skillStat);
            if($skill->skillType){
                $new->setSkillType($skill->skillType->__toString());
            }
            $this->em->persist($new);
        }
        $this->em->flush();
    }
}