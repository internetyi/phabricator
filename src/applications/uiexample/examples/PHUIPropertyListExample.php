<?php

final class PHUIPropertyListExample extends PhabricatorUIExample {

  public function getName() {
    return pht('Property List');
  }

  public function getDescription() {
    return pht(
      'Use %s to render object properties.',
      phutil_tag('tt', array(), 'PHUIPropertyListView'));
  }

  public function renderExample() {
    $request = $this->getRequest();
    $user = $request->getUser();

    $details1 = id(new PHUIListItemView())
      ->setName(pht('Details'))
      ->setSelected(true);

    $details2 = id(new PHUIListItemView())
      ->setName(pht('Rainbow Info'))
      ->setStatusColor(PHUIListItemView::STATUS_WARN);

    $details3 = id(new PHUIListItemView())
      ->setName(pht('Pasta Haiku'))
      ->setStatusColor(PHUIListItemView::STATUS_FAIL);

    $statustabs = id(new PHUIListView())
      ->setType(PHUIListView::NAVBAR_LIST)
      ->addMenuItem($details1)
      ->addMenuItem($details2)
      ->addMenuItem($details3);

    $view = new PHUIPropertyListView();

    $view->addProperty(
      pht('Color'),
      pht('Yellow'));

    $view->addProperty(
      pht('Size'),
      pht('Mouse'));

    $view->addProperty(
      pht('Element'),
      pht('Electric'));

    $view->addTextContent(
      'Lorem ipsum dolor sit amet, consectetur adipiscing elit. '.
      'Quisque rhoncus tempus massa, sit amet faucibus lectus bibendum '.
      'viverra. Nunc tempus tempor quam id iaculis. Maecenas lectus '.
      'velit, aliquam et consequat quis, tincidunt id dolor.');


    $view2 = new PHUIPropertyListView();
    $view2->addSectionHeader(pht('Colors of the Rainbow'));

    $view2->addProperty('R', pht('Red'));
    $view2->addProperty('O', pht('Orange'));
    $view2->addProperty('Y', pht('Yellow'));
    $view2->addProperty('G', pht('Green'));
    $view2->addProperty('B', pht('Blue'));
    $view2->addProperty('I', pht('Indigo'));
    $view2->addProperty('V', pht('Violet'));


    $view3 = new PHUIPropertyListView();
    $view3->addSectionHeader(pht('Haiku About Pasta'));

    $view3->addTextContent(
      hsprintf(
        '%s<br />%s<br />%s',
        pht('this is a pasta'),
        pht('haiku. it is very bad.'),
        pht('what did you expect?')));

    $object_box1 = id(new PHUIObjectBoxView())
      ->setHeaderText(pht('%s Stackered', 'PHUIPropertyListView'))
      ->addPropertyList($view, $details1)
      ->addPropertyList($view2, $details2)
      ->addPropertyList($view3, $details3);

    $edge_cases_view = new PHUIPropertyListView();

    $edge_cases_view->addProperty(
      pht('Description'),
      pht(
        'These layouts test UI edge cases in the element. This block '.
        'tests wrapping and overflow behavior.'));

    $edge_cases_view->addProperty(
      pht('A Very Very Very Very Very Very Very Very Very Long Property Label'),
      pht(
        'This property label and property value are quite long. They '.
        'demonstrate the wrapping behavior of the element, or lack thereof '.
        'if something terrible has happened.'));

    $edge_cases_view->addProperty(
      pht('AVeryVeryVeryVeryVeryVeryVeryVeryVeryVeryLongUnbrokenPropertyLabel'),
      pht(
        'Thispropertylabelandpropertyvaluearequitelongandhave'.
        'nospacestheydemonstratetheoverflowbehavioroftheelement'.
        'orlackthereof.'));


    $edge_cases_view->addProperty(
      pht('Description'),
      pht('The next section is an empty text block.'));

    $edge_cases_view->addTextContent('');

    $edge_cases_view->addProperty(
      pht('Description'),
      pht('This section should have multiple properties with the same name.'));

    $edge_cases_view->addProperty(
      pht('Joe'),
      pht('Smith'));
    $edge_cases_view->addProperty(
      pht('Joe'),
      pht('Smith'));
    $edge_cases_view->addProperty(
      pht('Joe'),
      pht('Smith'));

    $object_box2 = id(new PHUIObjectBoxView())
      ->setHeaderText(pht('Some Bad Examples'))
      ->addPropertyList($edge_cases_view);

    return array(
      $object_box1,
      $object_box2,
    );
  }
}
